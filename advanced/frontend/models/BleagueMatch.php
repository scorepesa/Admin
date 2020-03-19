<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bleague_match".
 *
 * @property integer $match_id
 * @property integer $parent_match_id
 * @property string $home_team
 * @property string $away_team
 * @property string $start_time
 * @property string $game_id
 * @property integer $competition_id
 * @property integer $status
 * @property string $bet_closure
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property string $result
 * @property string $ht_score
 * @property string $ft_score
 * @property integer $completed
 * @property integer $priority
 */
class BleagueMatch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bleague_match';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_match_id', 'home_team', 'away_team', 'start_time', 'game_id', 'competition_id', 'status', 'bet_closure', 'created_by', 'created'], 'required'],
            [['parent_match_id', 'competition_id', 'status', 'completed', 'priority'], 'integer'],
            [['start_time', 'instance_id', 'bet_closure', 'created', 'modified'], 'safe'],
            [['home_team', 'away_team'], 'string', 'max' => 50],
            [['game_id'], 'string', 'max' => 6],
            [['created_by'], 'string', 'max' => 60],
            [['result'], 'string', 'max' => 45],
            [['ht_score', 'ft_score'], 'string', 'max' => 5],
            [['game_id'], 'unique'],
            [['parent_match_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'match_id' => 'Match ID',
            'parent_match_id' => 'Parent Match ID',
            'home_team' => 'Home Team',
            'away_team' => 'Away Team',
            'start_time' => 'Start Time',
            'game_id' => 'Game ID',
            'competition_id' => 'Competition ID',
            'status' => 'Status',
            'instance_id' => 'instance id',
            'bet_closure' => 'Bet Closure',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'result' => 'Result',
            'ht_score' => 'Ht Score',
            'ft_score' => 'Ft Score',
            'completed' => 'Completed',
            'priority' => 'Priority',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetition() {
        return $this->hasOne(Competition::className(), ['competition_id' => 'competition_id']);
    }

    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getCompetitionName() {
        return $this->competition->competition_name;
    }

    public function fetch_competitions() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(competition_name, ' - ',competition_id) AS _competition", 'competition_id'])
                ->from('bleague_competition')
                ->all();
                
        foreach ($rows as $key => $value) {
            $data[$value['competition_id']] = $value['_competition'];
        }
        return $data;
    }

    public function match_to_add() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(parent_match_id, ' - ' ,home_team, ' - ', away_team) AS _match", 'parent_match_id'])
                ->from('match')
                ->where(['status'=>'1'])
                ->andWhere('start_time < ' . new \yii\db\Expression('NOW() + INTERVAL 20 DAY'))
                ->andFilterWhere(['>', 'start_time', new \yii\db\Expression('NOW()')])
                 
                /*->createCommand();
                 echo print_r($rows->sql);die();*/
        
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['parent_match_id']] = $value['_match'];
        }
        return $data;
    }

    public function add_matches($parent_match_ids)
    {

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try{
            // insert matches
            foreach($parent_match_ids as $value){
                //$sql = "SELECT * INTO `bleague_match` FROM `match` WHERE parent_match_id = '$value';";

                $sql = "INSERT INTO bleague_match SELECT * FROM `match` WHERE parent_match_id = '$value'";

                $connection->createCommand($sql)->execute();
            }

            $transaction->commit();
            return TRUE;
        }catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }
    }

}
