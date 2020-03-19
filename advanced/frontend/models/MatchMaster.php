<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "match".
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
 *
 * @property BetSlip[] $betSlips
 */
class MatchMaster extends \yii\db\ActiveRecord {

    public $fulltime_score;
    public $halftime_score;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'match';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_match_id', 'home_team', 'away_team', 'start_time', 'game_id', 'competition_id', 'status', 'bet_closure', 'created_by', 'created'], 'required'],
            [['parent_match_id', 'competition_id', 'status', 'completed', 'priority'], 'integer'],
            [['start_time', 'bet_closure', 'created', 'modified'], 'safe'],
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
    public function attributeLabels() {
        return [
            'match_id' => 'Match ID',
            'parent_match_id' => 'Parent Match ID',
            'home_team' => 'Home Team',
            'away_team' => 'Away Team',
            'start_time' => 'Start Time',
            'game_id' => 'Game ID',
            'competition_id' => 'Competition ID',
            'status' => 'Status',
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
    public function getBetSlips() {
        return $this->hasMany(BetSlipMaster::className(), ['parent_match_id' => 'parent_match_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventOdd() {
        return $this->hasMany(EventOdd::className(), ['parent_match_id' => 'parent_match_id']);
    }

    /**
     * @inheritdoc
     * @return MatchQuery the active query used by this AR class.
     */
    public static function find() {
        return new MatchQuery(get_called_class());
    }

    public function dailyShareMatches() {
        $matches = array();
        $sql = "SELECT m.game_id, CONCAT(m.home_team , ' vs ' ,m.away_team) AS teams, 
            DATE_FORMAT(m.start_time, '%H:%i') AS da, 
            GROUP_CONCAT(CONCAT(e.odd_key,'=',e.odd_value)
            ORDER BY FIELD(e.odd_key,1,'x',2)) AS gc FROM `match` m 
            INNER JOIN event_odd e on e.parent_match_id = m.parent_match_id 
            INNER JOIN competition c ON c.competition_id = m.competition_id 
            WHERE c.sport_id = 14 AND DATE(m.start_time) = DATE(DATE_ADD(NOW(), INTERVAL 2 HOUR)) 
            AND e.sub_type_id = 10 AND m.start_time > now() 
            GROUP BY e.parent_match_id ORDER BY m.priority DESC, c.priority DESC, m.start_time 
            LIMIT 100";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $key => $value) {
            $matches[] = $value['game_id'] . "-" . $value['teams'] . "-"
                    . $value['da'] . "( " . $value['gc'] . " )";
        }
        return $matches;
    }

    public function getSettled(){
        if(date_add(date_create($this->bet_closure), date_interval_create_from_date_string('2 hour')) > date('now')){
               return "NOT DUE";
        }
        $q = "select count(*) from outcome where parent_match_id = $this->parent_match_id";
        $data = Yii::$app->db->createCommand($q)->queryAll();
        if(empty($data)){
           return "NO SETTLED";
        }else{
           return "SETTLED";
        }

    }

    public function check_approved_status($parent_match_id) {
        $command = (new \yii\db\Query())
                ->select('*')
                ->from('outcome')
                ->where(['=', 'parent_match_id', $parent_match_id])
                ->andWhere(['<>', 'sub_type_id', -1])
                ->andwhere(['=', 'approved_status', 0]);

        $rows = $command->all();

        if (count($rows) > 0):
            return TRUE;
        endif;
        return FALSE;
    }

}
