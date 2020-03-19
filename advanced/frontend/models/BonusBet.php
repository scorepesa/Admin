<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bonus_bet".
 *
 * @property integer $bonus_bet_id
 * @property integer $bet_id
 * @property string $bet_amount
 * @property string $possible_win
 * @property integer $profile_bonus_id
 * @property integer $won
 * @property integer $status
 * @property string $ratio
 * @property string $created_by
 * @property string $created
 * @property string $modified
 *
 * @property Bet $bet
 * @property ProfileBonus $profileBonus
 */
class BonusBet extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'bonus_bet';
    }

    public static function getDb() {
        return Yii::$app->slavedb;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['bet_id', 'bet_amount', 'possible_win', 'profile_bonus_id', 'ratio', 'created_by', 'created'], 'required'],
            [['bet_id', 'profile_bonus_id', 'won'], 'integer'],
            [['bet_amount', 'possible_win', 'ratio'], 'number'],
            [['created', 'modified', 'status'], 'safe'],
            [['created_by'], 'string', 'max' => 70],
            [['bet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bet::className(), 'targetAttribute' => ['bet_id' => 'bet_id']],
            [['profile_bonus_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProfileBonus::className(), 'targetAttribute' => ['profile_bonus_id' => 'profile_bonus_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'bonus_bet_id' => 'Bonus Bet ID',
            'bet_id' => 'Bet ID',
            'bet_amount' => 'Bet Amount',
            'possible_win' => 'Possible Win',
            'profile_bonus_id' => 'Profile Bonus ID',
            'won' => 'Won',
            'status' => 'Status',
            'ratio' => 'Ratio',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBet() {
        return $this->hasOne(Bet::className(), ['bet_id' => 'bet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfileBonus() {
        return $this->hasOne(ProfileBonus::className(), ['profile_bonus_id' => 'profile_bonus_id']);
    }

    /**
     * 
     * @param type $refund_amount
     * @param type $profile_id
     * @param type $trx_reference
     * @param type $punter_account
     * @param type $rt_account
     * @return boolean
     */
    public function refund_invalid_bet($refund_amount, $profile_id, $trx_reference, $punter_account, $rt_account, $ratio) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $user = Yii::$app->user->identity->username;
            $trx_model = new Transaction();
            $bonus_refund = $ratio * $refund_amount;
            $bonus_refund = $bonus_refund > 0 ? $bonus_refund : 0;
            $actual_refund = $refund_amount - $bonus_refund;
            $actual_refund = $actual_refund > 0 ? $actual_refund : 0;
            $connection->createCommand()
                    ->batchInsert('bonus_trx', ['amount', 'account',
                        'created', 'created_by', 'iscredit', 'profile_id',
                        'reference'], [
                        [$bonus_refund, $punter_account,
                            date('Y-m-d H:i:s'), $user, 1, $profile_id,
                            $trx_reference],
                        [$bonus_refund, $rt_account,
                            date('Y-m-d H:i:s'), $user, 0, 6,
                            $trx_reference],
                    ])
                    ->execute();
            $connection->createCommand()
                    ->batchInsert('transaction', ['amount', 'account',
                        'created', 'created_by', 'iscredit', 'profile_id',
                        'running_balance', 'reference'], [
                        [$actual_refund, $punter_account,
                            date('Y-m-d H:i:s'), $user, 1, $profile_id,
                            $refund_amount, $trx_reference],
                        [$actual_refund, $rt_account,
                            date('Y-m-d H:i:s'), $user, 0, 6,
                            $refund_amount, $trx_reference],
                    ])
                    ->execute();


            //insert into queue
            $exchange = 'SCOREPESA_WINNER_MESSAGES_QUEUE';
            $queue = 'SCOREPESA_WINNER_MESSAGES_QUEUE';
            //fetch profile details
            $betId = $this->bet_id;
            $profile_obj = \app\models\Profile::find()
                    ->where('profile_id = :profile_id', [':profile_id' => $profile_id])
                    ->one();
            $profile_bal_obj = \app\models\ProfileBalance::find()
                    ->where('profile_id = :profile_id', [':profile_id' => $profile_id])
                    ->one();
            $account_balance = isset($profile_bal_obj->balance) ? $profile_bal_obj->balance : 0;
            //construct message

            $message = "Dear punter your bet, Bet ID " . $betId . " was cancelled. Your scorepesa account balance is Kshs. " . $account_balance . ". Scorepesa terms and conditions apply.";

            $this->status = 9;

            //save outbox
            $outbox_model = new \app\models\Outbox();

            $outbox_data = array("Outbox" => array(
                    "msisdn" => $profile_obj->msisdn,
                    "shortcode" => "719408",
                    "network" => "SAFARICOM",
                    "profile_id" => $profile_id,
                    "linkid" => "6013852000120687",
                    "date_created" => date('Y-m-d H:i:s'),
                    "date_sent" => date('Y-m-d H:i:s'),
                    "retry_status" => 8,
                    "modified" => date('Y-m-d H:i:s'),
                    "text" => $message,
                    "sdp_id" => "6013852000120687"
            ));
            $transaction->commit();

            if ($outbox_model->load($outbox_data) && $outbox_model->save()) {
                $data = array(
                    "refNo" => $profile_obj->msisdn . "_" . $outbox_model->outbox_id,
                    "msisdn" => $profile_obj->msisdn,
                    "message" => $outbox_model->text
                );
                $dataArray = array("queue.QMessage" => $data);
                $message = json_encode($dataArray);

//                Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
//                Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
//                Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
//                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);
            }


            $this->save();
            return TRUE;
        } catch (Exception $ex) {
            $transaction->rollback();
        }
    }

}
