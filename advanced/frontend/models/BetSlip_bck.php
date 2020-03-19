<?php

namespace app\models;

use yii\helpers\Html;
use app\models\VoidBetSlip;
use yii\db\Connection;
use Yii;

/**
 * This is the model class for table "bet_slip".
 *
 * @property integer $bet_slip_id
 * @property integer $parent_match_id
 * @property integer $bet_id
 * @property string $bet_pick
 * @property string $special_bet_value
 * @property integer $total_games
 * @property string $odd_value
 * @property integer $win
 * @property string $created
 * @property string $modified
 * @property integer $status
 * @property integer $sub_type_id
 * @property integer $live_bet 
 * @property Bet $bet
 * @property Match $parentMatch
 * @property LiveMatch $parentLiveMatch
 * 
 */
class BetSlip extends \yii\db\ActiveRecord {

    public $fulltime_score;
    public $halftime_score;
    public $cust_result;
    public $anytime_goal_scorers;
    public $stPeriod_score;
    public $ndPeriod_score;
    public $rdPeriod_score;
    public $AOT_score;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'bet_slip';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_match_id', 'bet_id','live_bet','bet_pick', 'total_games', 'odd_value', 'win', 'created', 'status', 'sub_type_id'], 'required'],
            [['parent_match_id', 'bet_id', 'live_bet', 'total_games', 'win', 'status', 'sub_type_id'], 'integer'],
            [['odd_value'], 'number'],
            [['created', 'live_bet', 'modified', 'halftime_score', 'fulltime_score',
            'cust_result', 'anytime_goal_scorers', 'stPeriod_score',
            'ndPeriod_score', 'rdPeriod_score', 'AOT_score'], 'safe'],
            [['bet_pick'], 'string', 'max' => 10],
            [['special_bet_value'], 'string', 'max' => 20],
            [['bet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bet::className(), 'targetAttribute' => ['bet_id' => 'bet_id']],
            [['parent_match_id'], 'exist', 'skipOnError' => true, 'targetClass' => Match::className(), 'targetAttribute' => ['parent_match_id' => 'parent_match_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'bet_slip_id' => Yii::t('app', 'Bet Slip ID'),
            'parent_match_id' => Yii::t('app', 'Parent Match ID'),
            'bet_id' => Yii::t('app', 'Bet ID'),
            'bet_pick' => Yii::t('app', 'Bet Pick'),
            'special_bet_value' => Yii::t('app', 'Special Bet Value'),
            'total_games' => Yii::t('app', 'Total Games'),
            'odd_value' => Yii::t('app', 'Odd Value'),
            'win' => Yii::t('app', 'Win'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'status' => Yii::t('app', 'Status'),
            'sub_type_id' => Yii::t('app', 'Sub Type ID'),
            'live_bet' => Yii::t('app','Live Bet'),
            'fulltime_score' => 'Full Time Score',
            'halftime_score' => 'Half Time Score',
            'cust_result' => 'Custom Result',
            'anytime_goal_scorers' => 'Anytime Goal scorers',
            'stPeriod_score' => '1st Period score',
            'ndPeriod_score' => '2nd Period score',
            'rdPeriod_score' => '3rd Period score',
            'AOT_score' => 'AT Overtime score',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBet() {
        return $this->hasOne(BetMaster::className(), ['bet_id' => 'bet_id']);
    }

    public function getBetMessage() {
        return $this->bet->bet_message;
    }

    public function getMatch() {
        if ($this->live_bet == 1) {
            return $this->parentLiveMatch->home_team . ' VS ' . $this->parentLiveMatch->away_team;
        } else {
            return $this->parentMatch->home_team . ' VS ' . $this->parentMatch->away_team;
        }
    }

    public function getBetMatch() {
         return $this->parentMatch->home_team . ' VS ' . $this->parentMatch->away_team;
    }


    public function getHome_team() {
        if ($this->live_bet == 1) {
            return $this->parentLiveMatch->home_team;
        } else {
            return $this->parentMatch->home_team;
        }
    }

    public function getAway_team() {
        if ($this->live_bet == 1) {
            return $this->parentLiveMatch->away_team;
        } else {
            return $this->parentMatch->away_team;
        }
    }

    public function getLiveBetTime() {
        if ($this->live_bet == 1) {
            return $this->parentLiveMatch->start_time;
        } else {
            return '';
        }
    }

    public function getHtFtScore() {
        if ($this->live_bet == 1) {
            return ' - ';
        } else {
            return $this->parentMatch->ht_score . ' - ' . $this->parentMatch->ft_score;
        }
    }

    public function getSubType() {
        return $this->hasOne(OddType::className(), ['sub_type_id' => 'sub_type_id', 'live_bet' => 'live_bet']);
    }

    public function getResultingSubType() {
        return $this->hasOne(OddType::className(), ['sub_type_id' => 'sub_type_id']);
    }

    public function getGameId() {
        if ($this->live_bet == 1) {
            return $this->parentLiveMatch->game_id;
        } else {
            return $this->parentMatch->game_id;
        }
    }

    public function getBetGameId() {
        return $this->parentMatch->game_id;
    }

    public function getSubtypeName() {
        return $result = isset($this->subType->name) ? $this->subType->name : "";
    }

    public function getResultingSubtypeName() {
        return $result = isset($this->resultingSubType->name) ? $this->resultingSubType->name : "";
    }

    public function getOutcome() {
        return $this->hasMany(Outcome::className(), ['parent_match_id' => 'parent_match_id',
                    'sub_type_id' => 'sub_type_id', 'special_bet_value' => 'special_bet_value',
                    'live_bet' => 'live_bet']);
    }

    public function getOutcomeValue() {
        $data = "";

        if ($this->outcome) {
            $str = "";
            foreach ($this->outcome as $value) {
                $data .= $str . $value->winning_outcome;
                $str = ",";
            }
            return $data;
        }
        return 'N/A';
    }

    public function getPossibleOutcome() {
        $result = EventOdd::find()->where(['parent_match_id' => $this->parent_match_id, 'sub_type_id' => $this->sub_type_id]);
        return $result->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentMatch() {
        return $this->hasOne(MatchMaster::className(), ['parent_match_id' => 'parent_match_id']);
    }

    public function getParentLiveMatch() {
        return $this->hasOne(LiveMatch::className(), ['parent_match_id' => 'parent_match_id']);
    }

    public function voidMatch($parent_match_ids, $sub_type_id=null, $live_bet=0) {
//fetch betslips with the match(es) 2 void
        if (is_array($parent_match_ids)) {
            foreach ($parent_match_ids as $match_id) {
                $match_ids[] = $match_id;
            }
        } else {
            $match_ids[] = $parent_match_ids;
        }
//$_match_ids = join(',', $match_ids);

        $bet_slips = $this->fetch_bet_slips($match_ids, $sub_type_id, $live_bet);

//prcess bet slips
        $result = $this->process_bet_slip($bet_slips, $parent_match_ids, $sub_type_id, $live_bet);
        return $result;
    }

    protected function process_bet_slip($bet_slips, $parent_match_ids, $sub_type_id, $live_bet) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {

            foreach ($bet_slips as $key => $bet_slip) {
             //insert into void_bet_slip 
                $bet_id = $bet_slip['bet_id'];
                $bet_pick = $bet_slip['bet_pick'];
                $parent_match_id = $bet_slip['parent_match_id'];
                $odd_value = $bet_slip['odd_value'];
                $special_bet_value = !empty($bet_slip['special_bet_value']) ? $bet_slip['special_bet_value'] : "";
                $status = $bet_slip['status'];
                $_sub_type_id = $bet_slip['sub_type_id'];
                $win = $bet_slip['win'];
                $total_games = $bet_slip['total_games'];
                $created = $bet_slip['created'];
                $modified = $bet_slip['modified'];

                $vbsql = "INSERT INTO void_bet_slip VALUES(0,$parent_match_id,$bet_id,"
                        . "'$bet_pick','$special_bet_value',$total_games,"
                        . "$odd_value,$win,$live_bet,'$created','$modified',$status,$_sub_type_id)";

                $connection->createCommand($vbsql)->execute();
            }

            foreach ($parent_match_ids as $key => $parent_match_id) {
                /* update bet b inner join bet_slip s using(bet_id) set b.total_odd=b.total_odd/s.odd_value,
                  b.possible_win=b.possible_win/s.odd_value where s.parent_match_id=
                 */

                $ex_sql = '';
                $livebet_cond = '';
                if (!empty($sub_type_id)):
                    $ex_sql = " AND s.sub_type_id = $sub_type_id";
                endif;
                if (!empty($live_bet==1)):
                   $livebet_cond = " AND live_bet=$live_bet";
                endif;
                $bsql = 'UPDATE bet b '
                        . 'INNER JOIN bet_slip s '
                        . 'USING(bet_id) '
                        . 'SET b.total_odd = b.total_odd/s.odd_value, '
                        . 'b.possible_win=b.possible_win/s.odd_value, s.odd_value=s.odd_value/s.odd_value, special_bet_value="", '
                        . 'sub_type_id=-1, bet_pick=-1  '
                        . 'WHERE s.parent_match_id = ' . $parent_match_id . ' AND  s.sub_type_id <> -1' . $ex_sql . $livebet_cond;

                $connection->createCommand($bsql)->execute();
            }
            $transaction->commit();
//create outcome and push to queue, sub_type_id=-1,pick=-1
            return TRUE;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $e->getMessage();
        }
    }

    protected function fetch_bet_slips($parent_match_id, $sub_type_id, $live_bet=0) {
        if (empty($sub_type_id)):
            $command = (new \yii\db\Query())
                    ->select('*')
                    ->from('bet_slip')
                    ->where(['in', 'parent_match_id', $parent_match_id])
                    ->andWhere(['<>', 'sub_type_id', -1])
                    ->andWhere(['=', 'live_bet', $live_bet])
                    ->andWhere(['=', 'status', 1]);
        else:
            $command = (new \yii\db\Query())
                    ->select('*')
                    ->from('bet_slip')
                    ->where(['in', 'parent_match_id', $parent_match_id])
                    ->andWhere(['<>', 'sub_type_id', -1])
                    ->andWhere(['=', 'live_bet', $live_bet])
                    ->andWhere(['=', 'sub_type_id', $sub_type_id])
                    ->andWhere(['=', 'status', 1]);
        endif;

        /* print_r($command->createCommand()->sql);
          die(); */
        $rows = $command->all();

        return $rows;
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

    protected function fetch_bet_slip_cond($parent_match_id) {
        $sql = "SELECT * FROM bet_slip WHERE bet_id IN(SELECT bet_id FROM bet_slip GROUP BY bet_id HAVING parent_match_id IN(7366763,9537847))";
        \Yii::$app->db->createCommand($sql)->execute();

        return $rows;
    }

    public function matches_to_void() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(home_team, ' vs ', away_team, ' - ',game_id) AS _match", 'parent_match_id'])
                ->from('match')
                ->where('start_time > ' . new \yii\db\Expression('NOW() - INTERVAL 60 DAY'))
                ->andwhere('start_time < ' . new \yii\db\Expression('NOW()'))
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['parent_match_id']] = $value['_match'];
        }
        return $data;
    }

    public function live_matches_to_void() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(home_team, ' vs ', away_team, ' - ',game_id) AS _match", 'parent_match_id'])
                ->from('live_match')
                ->where('start_time > ' . new \yii\db\Expression('NOW() - INTERVAL 60 DAY'))
                ->andwhere('start_time < ' . new \yii\db\Expression('NOW()'))
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['parent_match_id']] = $value['_match'];
        }
        return $data;
    }


    public function all_odd_types() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(name,' - ',sub_type_id) AS _oddtype", 'sub_type_id'])
                ->from('odd_type')
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['sub_type_id']] = $value['_oddtype'];
        }
        return $data;
    }

    public function some_odd_types($ids) {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(name,' - ',sub_type_id) AS _oddtype", 'sub_type_id'])
                ->from('odd_type')
                ->where("sub_type_id IN(" . join(",", $ids) . ")")
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['sub_type_id']] = $value['_oddtype'];
        }
        return $data;
    }

    public function match_sport($parent_match_id) {
        $row = (new \yii\db\Query())
                ->select(['sport.sport_id', 'competition_name', 'parent_match_id'])
                ->from('match')
                ->join('inner join', 'competition', '(match.competition_id = competition.competition_id)')
                ->join('inner join', 'sport', '(competition.sport_id = sport.sport_id)')
                ->where(["=", "parent_match_id", $parent_match_id])
                ->one();

        return $row;
    }

    public function outcome_dropdown($subtype, $parent_match, $key) {
        $model = new EventOdd();
        $data = $model->findAll(["sub_type_id" => $subtype, "parent_match_id" => $parent_match]);

        $result = '';
        $list = [];

        foreach ($data as $ev_odd) {
            $list[$ev_odd->odd_key] = $ev_odd->odd_key;
            if ($ev_odd->sub_type_id == 47):
                $list["X"] = "X";
            endif;
        }

        return $list;
    }

    public function outcome_special_bet_values($subtype, $parent_match) {
        $model = new EventOdd();
        $data = $model->findAll(["sub_type_id" => $subtype, "parent_match_id" => $parent_match]);

        $list = FALSE;

        foreach ($data as $ev_odd) {
            if (!empty($ev_odd->special_bet_value) && $model->sub_type_id == 236 || $model->sub_type_id == 272):
                $list[$ev_odd->special_bet_value] = $ev_odd->special_bet_value;
            endif;
        }

        return $list;
    }

    public function event_anytime_goal_scorers($parent_match_id) {
        $model = new EventOdd();
        $data = $model->findAll(["sub_type_id" => 235, "parent_match_id" => $parent_match_id]);

        $list = FALSE;

        foreach ($data as $ev_odd) {
            if ($ev_odd->sub_type_id == 235):
                $list[$ev_odd->odd_key] = $ev_odd->odd_key;
            endif;
        }

        return $list;
    }

    public function getMatchSport($parent_match_id) {
        $row = (new \yii\db\Query())
                ->select(['competition.sport_id'])
                ->from('match')
                ->innerJoin('competition', 'match.competition_id=competition.competition_id')
                ->where(["match.parent_match_id" => $parent_match_id])
                ->one();
        /* ->createCommand();
          echo print_r($row->sql);
          die(); */

        return $row['sport_id'];
    }

}
