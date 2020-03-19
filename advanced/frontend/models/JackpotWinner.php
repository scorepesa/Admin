<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jackpot_winner".
 *
 * @property integer $jackpot_winner_id
 * @property integer $win_amount
 * @property integer $bet_id
 * @property integer $jackpot_event_id
 * @property integer $total_games_correct
 * @property string $created_by
 * @property integer $status
 * @property string $created
 * @property string $modified
 *
 * @property Bet $bet
 * @property JackpotEvent $jackpotEvent
 */
class JackpotWinner extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'jackpot_winner';
    }

    public static function getDb() {
        return Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['win_amount', 'bet_id', 'jackpot_event_id', 'total_games_correct', 'created_by', 'created'], 'required'],
            [['win_amount', 'bet_id', 'jackpot_event_id', 'total_games_correct', 'status'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['created_by'], 'string', 'max' => 70],
            [['bet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bet::className(), 'targetAttribute' => ['bet_id' => 'bet_id']],
            [['jackpot_event_id'], 'exist', 'skipOnError' => true, 'targetClass' => JackpotEvent::className(), 'targetAttribute' => ['jackpot_event_id' => 'jackpot_event_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'jackpot_winner_id' => 'Jackpot Winner ID',
            'win_amount' => 'Win Amount',
            'bet_id' => 'Bet ID',
            'jackpot_event_id' => 'Jackpot Event ID',
            'total_games_correct' => 'Total Games Correct',
            'created_by' => 'Created By',
            'status' => 'Status',
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
    public function getJackpotEvent() {
        return $this->hasOne(JackpotEvent::className(), ['jackpot_event_id' => 'jackpot_event_id']);
    }

    public function getjpwinners($jackpot_event_id, $total_games_correct) {
        $rows = (new \yii\db\Query())
                ->select(["*"])
                ->from('jackpot_winner')
                ->where("jackpot_event_id=$jackpot_event_id and total_games_correct=$total_games_correct")
                ->all();
        /* ->createCommand();
          echo print_r($rows->sql);
          die(); */

        return $rows;
    }

    public function credit_jpwinners_accounts($jpwinners) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $credit_trx_data = null;
            foreach ($jpwinners as $key => $value) {
                $profile_data = fetch_profile_data($value['msisdn']);
                $pid = $profile_data['profile_id'];
                $ref_id = $value['bet_id'] . "_" . $value['jackpot_event_id'];
                //trx data
                $credit_trx_data[] = [
                    'amount' => $value['win_amount'],
                    'account' => $pid. "_VIRTUAL",
                    'created' => date('Y-m-d H:i:s'),
                    'created_by' => Yii::$app->name,
                    'iscredit' => 1,
                    'profile_id' => $pid,
                    'running_balance' => 0,
                    'reference' => $ref_id
                ];
                //profile balance data
                $profilebal_data[] = ['profile_id' => $pid,
                    'balance' => $value['win_amount'], 'transaction_id' => -1,
                    'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'),
                    'bonus_balance' => 0];
            }
            
            if (count($credit_trx_data) > 0 && count($debit_trx_data) > 0) {
                $trx_columns = ['amount', 'account', 'created', 'created_by', 'iscredit', 'profile_id',
                    'running_balance', 'reference'];
                $profilebal_columns = ['profile_id', 'balance', 'transaction_id', 'created', 'modified', 'bonus_balance'];
                // below line insert all your record and return number of rows inserted
                $credit_trx = $connection->queryBuilder->batchInsert('transaction', $trx_columns, $credit_trx_data);
                $pbalsql = $connection->queryBuilder->batchInsert('profile_balance', $profilebal_columns, $profilebal_data);
                $connection->createCommand($pbalsql . ' ON DUPLICATE KEY UPDATE balance=balance+' . $value['win_amount'] . "'")->execute();
            }
            $transaction->commit();
            return TRUE;
            //insert p_balance on dup update
        } catch (Exception $ex) {
            $transaction->rollback();
            return FALSE;
        }
    }

}
