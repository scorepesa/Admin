<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "bet".
 *
 * @property integer $bet_id
 * @property integer $profile_id
 * @property string $bet_message
 * @property string $total_odd
 * @property string $bet_amount
 * @property string $possible_win
 * @property integer $status
 * @property integer $win
 * @property string $reference
 * @property string $created_by
 * @property string $created
 * @property string $modified
 *
 * @property Profile $profile
 * @property BetSlip[] $betSlips
 * @property Winner[] $winners
 */
class BetMaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'bet';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['profile_id', 'bet_message', 'total_odd', 'bet_amount', 'possible_win', 'status', 'reference', 'created_by', 'created', 'modified'], 'required'],
            [['profile_id', 'status', 'win', 'number_to_award'], 'integer'],
            [['total_odd', 'bet_amount', 'possible_win'], 'number'],
            [['created', 'modified', 'number_to_award'], 'safe'],
            [['bet_message'], 'string', 'max' => 200],
            [['reference', 'created_by'], 'string', 'max' => 70],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'profile_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'bet_id' => Yii::t('app', 'Bet ID'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'bet_message' => Yii::t('app', 'Bet Message'),
            'total_odd' => Yii::t('app', 'Total Odd'),
            'bet_amount' => Yii::t('app', 'Bet Amount'),
            'possible_win' => Yii::t('app', 'Possible Win'),
            'status' => Yii::t('app', 'Status'),
            'win' => Yii::t('app', 'Win'),
            'reference' => Yii::t('app', 'Reference'),
            'created_by' => Yii::t('app', 'Created By'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'number_to_award' => Yii::t('app', 'Number To Award'),
        ];
    }
    
    public function getTotalStats(){
        $sql = "select count(*)bets, count(if(status<>200, bet_id, null))paid, count(if(status=200, bet_id, null))pending, count(if(status=3, bet_id, null))lost, count(if(status=5, bet_id, null))won, sum(bet_amount)stake, sum(if(status<>200, bet_amount, null))paid_stake, sum(if(status=200, bet_amount, null))unpaid_stake, sum(if(status =3,bet_amount, null))lost_stake, sum(if(status=5, possible_win, null))won_amount from bet where date(created) = curdate()";
        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return $result;
    }

    public function latestBetStats(){
        $sql = "select date_format(created, '%m-%d')date_created, count(*)bets, count(if(status<>200, bet_id, null))paid, count(if(status=3, bet_id, null))lost, count(if(status=5, bet_id, null))won from bet where date(created) >= now()-interval 7 day group by date_created";
        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return $result;

    }

    public function latestBetWinnings(){
        $sql = "select date_format(created, '%m-%d')date_created, sum(if(status=5, possible_win, null))win from bet where date(created) >= now()-interval 7 day group by date_created";
        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return $result;

    }

     public function todayDeposits(){
        $sql = "select date(created), count(*)as count, sum(mpesa_amt)deposit from mpesa_transaction where date(created) = curdate()";
        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return $result;

    }


    public function deposits(){
        $sql = "select date_format(created, '%m-%d')date_created, sum(mpesa_amt)deposit from mpesa_transaction where date(created) >= now()-interval 7 day group by date_created";
        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return $result;

    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile() {
        return $this->hasOne(Profile::className(), ['profile_id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBetSlips() {
        return $this->hasMany(BetSlipMaster::className(), ['bet_id' => 'bet_id']);
    }

    public function getProfileName() {
        return $this->profile->msisdn;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWinners() {
        return $this->hasMany(Winner::className(), ['bet_id' => 'bet_id']);
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
    public function refund_invalid_bet($refund_amount, $profile_id, $trx_reference, $punter_account, $rt_account) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $trx_model = new Transaction();
            $connection->createCommand()
                    ->batchInsert('transaction', ['amount', 'account',
                        'created', 'created_by', 'iscredit', 'profile_id',
                        'running_balance', 'reference'], [
                        [$refund_amount, $punter_account,
                            date('Y-m-d H:i:s'), Yii::$app->name, 1, $profile_id,
                            $refund_amount, $trx_reference],
                        [$refund_amount, $rt_account,
                            date('Y-m-d H:i:s'), Yii::$app->name, 0, 6,
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
            $this->save();
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

            if ($outbox_model->load($outbox_data) && $outbox_model->save()) {
                $data = array(
                    "refNo" => $profile_obj->msisdn . "_" . $outbox_model->outbox_id,
                    "msisdn" => $profile_obj->msisdn,
                    "message" => $outbox_model->text
                );
                $dataArray = array("queue.QMessage" => $data);
                $message = json_encode($dataArray);

                Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);
            }

            $transaction->commit();
            return TRUE;
        } catch (Exception $ex) {
            $transaction->rollback();
        }
    }

}
