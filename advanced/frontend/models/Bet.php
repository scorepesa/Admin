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
class Bet extends \yii\db\ActiveRecord {

    public $number_to_award;

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
            [['profile_id', 'status', 'win'], 'integer'],
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
            'number_to_award' => Yii::t('app', 'Number To Award')
        ];
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
        return $this->hasMany(BetSlip::className(), ['bet_id' => 'bet_id']);
    }

    public function getProfileName() {
        return $this->profile->msisdn;
    }

    public function getTotalGames() {
        return count($this->betSlips);
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
    public function refund_invalid_bet($bet_amount, $bonus_bet_amount, $profile_id) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            if ($this->modified >= date("Y-m-d h:i:s", strtotime("-30 minutes"))):
                $trx_reference = $this->bet_id . '_BETCANCEL';
                $punter_account = $profile_id . '_VIRTUAL';
                $rt_account = 'ROAMTECH_VIRTUAL';
                //can cancel
                $connection->createCommand()
                        ->batchInsert('transaction', ['amount', 'account',
                            'created', 'created_by', 'iscredit', 'profile_id',
                            'running_balance', 'reference'], [
                            [$bet_amount, $punter_account,
                                date('Y-m-d H:i:s'), Yii::$app->name, 1, $profile_id,
                                $bet_amount, $trx_reference],
                            [$bet_amount, $rt_account,
                                date('Y-m-d H:i:s'), Yii::$app->name, 0, 6,
                                $bet_amount, $trx_reference],
                        ])
                        ->execute();

                $pb_sql = "UPDATE profile_balance SET balance=(balance + $bet_amount),"
                        . " bonus_balance=(bonus_balance + $bonus_bet_amount) "
                        . "WHERE profile_id=$profile_id";
                $connection->createCommand($pb_sql)->execute();

                $this->status = 24;

                $bsql = 'UPDATE bet b INNER JOIN bet_slip s USING(bet_id) SET b.status=24, s.status=24 '
                        . 'WHERE b.bet_id=' . $this->bet_id;
                $connection->createCommand($bsql)->execute();

                $this->save();
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

                $message = "Bet ID " . $betId . " was cancelled. Your scorepesa account balance is Kshs. " . $account_balance . ". Scorepesa T&C apply.";

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

                    //Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                    //Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                    //Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
                    Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);
                }

                $transaction->commit();
                return TRUE;
            endif;
            return FALSE;
        } catch (Exception $ex) {
            $transaction->rollback();
            return FALSE;
        }
    }

    public function updateBetStatus($poststatus) {
        $connection = \Yii::$app->db;

        $sql = "UPDATE bet SET status = $poststatus WHERE bet_id=$this->bet_id";
        $connection->createCommand($sql)->execute();
        return TRUE;
    }

    /**
     * @todo Make configurable bonus_amount and number_to award
     * @return boolean
     */
    public function awardEarlyBirdPunters() {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        $sql = "SELECT distinct b.profile_id, msisdn, bet_id, b.created as bettime "
                . "FROM profile p INNER JOIN bet b ON p.profile_id = b.profile_id "
                . "WHERE DATE(b.created) = curdate() AND HOUR(b.created) "
                . "BETWEEN 5 AND 8  ORDER BY RAND() LIMIT 20";
        $data = $connection->createCommand($sql)->queryAll();
        try {
            foreach ($data as $value) {
                //insert profile_bonus 
                $bonu = "insert into profile_bonus values(0," . $value['profile_id'] . "," . $value['msisdn'] . ",100,'CLAIMED',now(),now(),null,1,'EARLYBIRDPUNTER')";
                $connection->createCommand($bonu)->execute();
                //update profile_balance bonus_balance
                $bal = "update profile_balance set bonus_balance = (bonus_balance+100) where profile_id=" . $value['profile_id'] . " limit 1";
                $connection->createCommand($bal)->execute();
            }
            $transaction->commit();
            return TRUE;
        } catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }
    }

    public function betdetail($bet_id) {
        $connection = \Yii::$app->db;
        $sql = "SELECT b.bet_id, b.reference, s.live_bet FROM bet b INNER JOIN bet_slip s USING(bet_id) "
                . "WHERE b.bet_id = $bet_id";
        $data = $connection->createCommand($sql)->queryAll();

        foreach ($data as $value) {
            return $value;
        }
    }

}
