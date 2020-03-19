<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jackpot_match".
 *
 * @property integer $jackpot_match_id
 * @property integer $parent_match_id
 * @property string $status
 * @property string $created_by
 * @property string $created
 * @property string $modified
 */
class JackpotMatch extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'jackpot_match';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_match_id', 'created_by', 'created', 'jackpot_event_id', 'status'], 'required'],
            [['parent_match_id', 'game_order', 'jackpot_event_id'], 'integer'],
            [['status'], 'string'],
            [['created', 'modified', 'game_order'], 'safe'],
            [['created_by'], 'string', 'max' => 70],
//            [['parent_match_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'jackpot_match_id' => 'Jackpot Match ID',
            'parent_match_id' => 'Parent Match ID',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'jackpot_event_id' => 'Jackpot Event ID',
            'game_order' => 'Game Order'
        ];
    }

    public function jackpot_viable_matches() {
        //$start_datetime = $this->jackpot_event_starttime();
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(home_team, ' vs ', away_team, ' - ',game_id, ', ', start_time) AS _match", 'parent_match_id'])
                ->from('match')
                ->where('start_time >' . new \yii\db\Expression('NOW() + INTERVAL 1 DAY'))
                ->andFilterWhere(['<', 'start_time', new \yii\db\Expression('NOW() + INTERVAL 14 DAY')])
                ->all();
        /* ->createCommand();
          echo print_r($rows->sql);
          die(); */
        foreach ($rows as $key => $value) {
            $data[$value['parent_match_id']] = $value['_match'];
        }
        return $data;
    }

    public function jackpot_event_starttime() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["", 'parent_match_id'])
                ->from('match')
                ->where('DATE(created)= DATE(NOW())')
                ->andFilterWhere(['<', 'start_time', new \yii\db\Expression('NOW() + INTERVAL  DAY')])
                ->all();
        /* ->createCommand();
          echo print_r($rows->sql);
          die(); */
        foreach ($rows as $key => $value) {
            $data[$value['parent_match_id']] = $value['_match'];
        }
        return $data;
    }

    public function fetch_jackpot_events() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(jackpot_name,' - ',jackpot_event_id) AS jpEventName", 'jackpot_event_id'])
                ->from('jackpot_event')
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['jackpot_event_id']] = $value['jpEventName'];
        }
        return $data;
    }

    public function saveJpMatches($parent_match_ids, $status, $created_by, $created, $jackpot_event_id, $game_order){

        // save data in table
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{
            $jp_match_order=$this->get_jackpot_match_order_id($jackpot_event_id);
		
	    if($jp_match_order != null){
            if (count($jp_match_order) > 0){
                $game_order = $jp_match_order['game_order']+1;
            }else{
                $game_order = 1;
            }
	    }else {
		$game_order = 1;
	    }
            // insert matches in jackpot match table
            foreach($parent_match_ids as $value){
                $sql = "INSERT INTO jackpot_match(parent_match_id, status, created_by, created, jackpot_event_id, game_order) VALUES('$value', '$status', '$created_by', '$created', '$jackpot_event_id', '$game_order')";
                $connection->createCommand($sql)->execute();
                $game_order++;
            }
        
            // get the start time for the first match  jackpot event
            $get_min_start_time = "SELECT min(start_time) FROM `match` m INNER JOIN jackpot_match jm ON m.parent_match_id = jm.parent_match_id WHERE jm.jackpot_event_id = '$jackpot_event_id'";

            $start_time = Yii::$app->db->createCommand($get_min_start_time)->queryColumn();

            $min_start_time= $start_time[0];

            // create event name
            $event_name = "jackpot_event_". $jackpot_event_id. "_inactive";

            //print($min_start_time);die();
            
            // schedule event
            $create_event = "
                
                CREATE EVENT IF NOT EXISTS $event_name
                ON SCHEDULE AT '$min_start_time'
                DO
                UPDATE jackpot_match jm INNER JOIN jackpot_event je ON jm.jackpot_event_id = je.jackpot_event_id SET jm.status = 'INACTIVE',je.status = 'INACTIVE' WHERE je.jackpot_event_id = '$jackpot_event_id';

                ";
            $result = $connection->createCommand($create_event)->execute();

            //print($result);die();

            $transaction->commit();
            return TRUE;
            

        } catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }

    }

    public function get_jackpot_match_order_id($jp_id) {
        $rows = (new \yii\db\Query())
                ->select(['game_order'])
                ->from('jackpot_match')
                ->where(["jackpot_event_id" => $jp_id])
                ->orderBy('jackpot_match_id DESC')
                ->one();
        //        ->createCommand();
	
        //echo $rows->sql;die();
        //print_r($rows->params); die();

        return $rows;
    }

}

