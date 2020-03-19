<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bleague_event_odd".
 *
 * @property integer $event_odd_id
 * @property integer $parent_match_id
 * @property integer $sub_type_id
 * @property string $max_bet
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property string $odd_key
 * @property string $odd_value
 * @property string $odd_alias
 * @property integer $status
 */
class BleagueEventOdd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bleague_event_odd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_match_id', 'sub_type_id', 'status'], 'integer'],
            [['max_bet', 'created_by', 'created', 'odd_key', 'approved_by', 'winning_outcome'], 'required'],
            [['max_bet'], 'number'],
            [['created', 'modified'], 'safe'],
            [['created_by', 'approved_by', 'winning_outcome'], 'string', 'max' => 45],
            [['odd_key', 'special_bet_value'], 'string', 'max' => 200],
            [['odd_value', 'odd_alias'], 'string', 'max' => 20],
            [['parent_match_id', 'sub_type_id', 'odd_key'], 'unique', 'targetAttribute' => ['parent_match_id', 'sub_type_id', 'odd_key'], 'message' => 'The combination of Parent Match ID, Sub Type ID and Odd Key has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_odd_id' => 'Event Odd ID',
            'parent_match_id' => 'Parent Match ID',
            'sub_type_id' => 'Sub Type ID',
            'max_bet' => 'Max Bet',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'odd_key' => 'Odd Key',
            'odd_value' => 'Odd Value',
            'special_bet_value' => 'Special Bet Value',
            'odd_alias' => 'Odd Alias',
            'status' => 'Status',
            'approved_by' => 'Approved By',
            'winning_outcome' => 'Winning Outcome',
        ];
    }

    public function match_to_add() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(parent_match_id, ' - ' ,home_team, ' - ', away_team) AS _match", 'parent_match_id'])
                ->from('bleague_match')
                ->where(['status'=>'1'])
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['parent_match_id']] = $value['_match'];
        }
        return $data;
    }

    public function fetch_custom_markets() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(sub_type_id, ' - ' ,name) AS _markets", 'sub_type_id'])
                ->from('odd_type')
                ->where(['like', 'sub_type_id', '-'])
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['sub_type_id']] = $value['_markets'];
        }
        return $data;
    }


    public function saveOdds($parent_match_id, $sub_type_id, $max_bet, $created_by, $created, $modified, $odd_key, $odd_value, $special_bet_value, $odd_alias, $status) {

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        
        try {
             $sql = "INSERT INTO bleague_event_odd(parent_match_id, sub_type_id, max_bet, created_by, created, modified, odd_key, odd_value, special_bet_value, odd_alias, status) 
                    VALUES('$parent_match_id', '$sub_type_id', '$max_bet', '$created_by', '$created', '$modified', '$odd_key', '$odd_value', '$special_bet_value', '$odd_alias', '$status')";

            $connection->createCommand($sql)->execute();
            $transaction->commit();
            return TRUE;
        } catch(Exception $e) {
              $transaction->rollback();
            return FALSE;
        }

    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getBleagueMatch()
    {
        return $this->hasOne(BleagueMatch::className(), ['parent_match_id' => 'parent_match_id']);
    }

     /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getHomeTeam() {
        return $this->bleagueMatch->home_team;
    }

     /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getAwayTeam() {
        return $this->bleagueMatch->away_team;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOddType()
    {
        return $this->hasOne(OddType::className(), ['sub_type_id' => 'sub_type_id']);
    }

     /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getName() {
        if($this->oddType) {
            return $this->oddType->name;   
        }
        return 'N/A';                
    }

    public function processOutcome($sub_type_id, $parent_match_id, $special_bet_value, $live_bet, $created_by, $created, $modified, $status, $approved_by, $approved_status, $date_approved, $winning_outcome, $event_odd_id, $void_factor){

        try {


            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();

            $sql = "INSERT INTO outcome(sub_type_id, parent_match_id, special_bet_value, live_bet, created_by, created, modified, status, approved_by, approved_status, date_approved, winning_outcome) 
                    VALUES('$sub_type_id', '$parent_match_id', '$special_bet_value', '$live_bet', '$created_by', now(), now(), '$status', '$approved_by', '$approved_status', '$date_approved', '$winning_outcome')";

            $connection->createCommand($sql)->execute();
            $match_result_id = $connection->getLastInsertID();

            // prepare data for queue
            $queue_name = 'SCOREPESA_OUTCOMES_QUEUE2';
            $exchange = 'SCOREPESA_OUTCOMES_QUEUE2';
            $_outcome = array();

            $_data = array(
                "outcomeSaveId" => $match_result_id,
                "outcomeKey" => (string) 1,
                "outcomeValue" => (string) $winning_outcome,
                "odd_type" => $sub_type_id,
                "voidFactor" => $void_factor,
            );

            if (!empty($special_bet_value)):
                $_data["specialBetValue"] = $special_bet_value;
            endif;

            array_push($_outcome, $_data);
            $data = array(
                "parent_match_id" => $parent_match_id,
                "live_bet" => !empty($live_bet) ? $live_bet : 0,
                "outcomes" => $_outcome
            );

            #sample json

           /*{
                "parent_match_id": "12125766",
                "sequenceNumber": 0,
                "outcomes": [{
                    "outcomeSaveId": 12518629,
                    "outcomeKey": "1",
                    "specialBetValue": "Mesii",
                    "outcomeValue": "YES",
                    "odd_type": "8142",
                    "voidFactor": "1.0",
                }],
                "live_bet": 0
            }*/

            $message = json_encode($data);

            // push to queue
            /*Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
            Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = false, $exclusive = false, $auto_delete = false);
            Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
            Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);
       */

            // push to queue
            Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
            Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
            Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
            Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);


            // update bleague_event_odd table with outcome
            $sql = "UPDATE bleague_event_odd SET status = 0,  approved_by = '$created_by', winning_outcome = '$winning_outcome' WHERE event_odd_id = '$event_odd_id'";
            $connection->createCommand($sql)->execute();

            // commit transactions
            $transaction->commit();

            return TRUE;

        } catch(Exception $e) {
            $transaction->rollback();
            return FALSE;
        }

    }
}
