<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outcome".
 *
 * @property integer $match_result_id
 * @property integer $sub_type_id
 * @property integer $parent_match_id
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property integer $status
 * @property string $winning_outcome
 * @property string $is_winning_outcome
 * @property integer $live_bet
 *
 * @property Match $parentMatch
 */
class Outcome extends \yii\db\ActiveRecord {

    public $odd_key;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'outcome';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sub_type_id', 'parent_match_id', 'created_by', 'created', 'winning_outcome'], 'required'],
            [['sub_type_id', 'parent_match_id', 'status', 'live_bet', 'is_winning_outcome'], 'integer'],
            [['odd_key', 'created', 'modified', 'special_bet_value', 'live_bet', 'approved_by', 'approved_status', 'date_approved'], 'safe'],
            [['created_by'], 'string', 'max' => 70],
            [['winning_outcome'], 'string', 'max' => 200],
            [['parent_match_id'], 'exist', 'skipOnError' => true, 'targetClass' => $this->live_bet == 0 ? Match::className() : LiveMatch::className(), 'targetAttribute' => ['parent_match_id' => 'parent_match_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'match_result_id' => 'Match Result ID',
            'sub_type_id' => 'Sub Type ID',
            'parent_match_id' => 'Parent Match ID',
            'special_bet_value' => 'Special Bet Value',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'status' => 'Status',
            'live_bet' => 'Live bet',
            'winning_outcome' => 'Winning Outcome',
            'approved_by' => 'Approved by',
            'approved_status' => 'Approved status',
            'date_approved' => 'Date approved',
            'odd_key' => 'Odd Key',
            'is_winning_outcome' => 'Is Winning Outcome'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentMatch() {
        if ($this->live_bet == 0) {
            return $this->hasOne(Match::className(), ['parent_match_id' => 'parent_match_id']);
        }
        return $this->hasOne(LiveMatch::className(), ['parent_match_id' => 'parent_match_id']);
    }

    public function getHomeTeam() {
        return isset($this->parentMatch->home_team) ? $this->parentMatch->home_team : "N/A";
    }

    public function getAwayTeam() {
        return isset($this->parentMatch->away_team) ? $this->parentMatch->away_team : "N/A";
    }

    public function updateOutcomeApproval($user, $outcome_subtype_id, $pmatch_id) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $sql = 'UPDATE outcome '
                    . 'SET approved_status=1, date_approved="' . date('Y-m-d H:i:s') . '", approved_by="' . $user . '"' .
                    'WHERE parent_match_id=' . $pmatch_id;

            \Yii::$app->db->createCommand($sql)->execute();
            $transaction->commit();
            return TRUE;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::info("Updating outcome approval Exception::" . $e->getMessage());
            return FALSE;
        }
    }

    public function revertUpdateOutcomeApproval($outcome_subtype_id, $pmatch_id) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $sql = 'UPDATE outcome '
                    . 'SET approved_status=0, date_approved="", approved_by=""' .
                    'WHERE sub_type_id =' . $outcome_subtype_id . ' and parent_match_id=' . $pmatch_id;

            \Yii::$app->db->createCommand($sql)->execute();
            $transaction->commit();
            return TRUE;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::info("Rollback Updating outcome approval Exception::" . $e->getMessage());
            return FALSE;
        }
    }

    public function updateMatchResultStatus($outcome_subtype_id, $pmatch_id, $match_result_id) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $sql = "UPDATE outcome SET status=0 WHERE sub_type_id = $outcome_subtype_id  and parent_match_id=$pmatch_id and match_result_id=$match_result_id";

            \Yii::$app->db->createCommand($sql)->execute();
            $transaction->commit();
            return TRUE;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::info("Updating outcome approval Exception::" . $e->getMessage());
            return FALSE;
        }
    }

    public function matches_to_result() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(parent_match_id, '  ', home_team, ' vs ', away_team, ' - ',game_id) AS _match", 'parent_match_id'])
                ->from('match')
                ->where('start_time > ' . new \yii\db\Expression('NOW() - INTERVAL 60 DAY'))
                ->andFilterWhere(['<', 'start_time', new \yii\db\Expression('NOW() - INTERVAL 2 HOUR')])
                ->all();
        /* ->createCommand();
          echo print_r($rows->sql);
          die(); */
        if(count($rows) > 0){
           foreach ($rows as $key => $value) {
               $data[$value['parent_match_id']] = $value['_match'];
           }
        } else {
           $rows = (new \yii\db\Query())
                ->select(["CONCAT(parent_match_id, '  ', home_team, ' vs ', away_team, ' - ',game_id) AS _match", 'parent_match_id'])
                ->from('live_match')
                ->where('start_time > ' . new \yii\db\Expression('NOW() - INTERVAL 10 DAY'))
                ->andFilterWhere(['<', 'start_time', new \yii\db\Expression('NOW() - INTERVAL 10 MINUTE')])
                ->all();
           foreach ($rows as $key => $value) {
               $data[$value['parent_match_id']] = $value['_match'];
           }
        }
        return $data;
    }

    public function live_matches_to_result() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(home_team, ' vs ', away_team, ' - ',game_id) AS _match", 'parent_match_id'])
                ->from('live_match')
                ->where('start_time > ' . new \yii\db\Expression('NOW() - INTERVAL 20 DAY'))
                ->andFilterWhere(['<', 'start_time', new \yii\db\Expression('NOW() - INTERVAL 10 MINUTE')])
                ->all();
//                ->createCommand();
  //      echo print_r($rows->sql);die();


        foreach ($rows as $key => $value) {
             $data[$value['parent_match_id']] = $value['_match'];
        }
        return $data;
    }

    public function all_odd_types() {
        $data = array();
        $q = (new \yii\db\Query())
                ->select(["CONCAT(m.parent_match_id, '  ', m.home_team, ' VS ' , m.away_team , ' -- ', sub_type_id, ' -- ', name) AS _oddtype", 'm.parent_match_id'])
                ->from('odd_type')
                ->join('INNER JOIN', '`match` m', 'm.parent_match_id = odd_type.parent_match_id')
                ->where('odd_type.sub_type_id = 1');
        $rows = $q->all();
        foreach ($rows as $key => $value) {
            $data[$value['parent_match_id']] = $value['_oddtype'];
        }
        return $data;
    }

   public function live_odd_types() {
        $data = array();
        $rows = (new \yii\db\Query())
                ->select(["CONCAT(name,' - ',sub_type_id) AS _oddtype", 'sub_type_id'])
                ->from('odd_type')
                ->where("live_bet=1")
                ->all();
        foreach ($rows as $key => $value) {
            $data[$value['sub_type_id']] = $value['_oddtype'];
        }
        return $data;
    }

    public function fetch_jumped_outcome() {
        $rows = (new \yii\db\Query())
                ->select(["*"])
                ->from('outcome')
                ->where("status=0 and winning_outcome is not null and winning_outcome <> '' and created >= curdate() - 2 and live_bet=0")
//                ->andWhere("winning_outcome is not null")
//                ->andWhere("winning_outcome <> ''")
//                ->andWhere("created >= curdate() - 2")
//                ->andWhere("live_bet=0")
                ->all();
//                ->createCommand();
//        echo print_r($rows->sql);
//        die();
        return $rows;
    }

    public function resultDrawnobet($parent_match_id, $market, $odd_key='') {

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        $user = \Yii::$app->user->identity->username;

        try {
            $bet_pick = '';
            $winning_outcome=[1, 2];
            if(!empty($odd_key)){
               $bet_pick = " AND s.bet_pick='$odd_key' ";
               $winning_outcome=$odd_key;
            }

            // query to refund only not won,cancelled or jackpot bets
            $sql = "UPDATE bet_slip s INNER JOIN bet b ON s.bet_id = b.bet_id SET 
                    s.bet_slip_id = last_insert_id(s.bet_slip_id),b.possible_win = b.possible_win / (s.odd_value * 1) ,
                    b.total_odd = b.total_odd/(s.odd_value * 1),s.odd_value = s.odd_value / (s.odd_value * 1) 
                    WHERE s.parent_match_id = '$parent_match_id' AND s.live_bet = '0' 
                    AND s.sub_type_id = $market AND s.special_bet_value = ''
                    AND s.status NOT IN (5,24, 9) $bet_pick";


            $params=array();

           
 
            if (is_array($winning_outcome)) {
                foreach ($winning_outcome as $k=>$v) { 
                     $params[]=[$market, $parent_match_id, '', 0, $user, date('Y-m-d H:i:s'), 0, $k];
                }
            } else {
                $params[]=[$market, $parent_match_id, '', 0, $user, date('Y-m-d H:i:s'), 0, $winning_outcome];
            }

            //print_r($params);die();

            // query to update outcome

            \Yii::$app->db->createCommand($sql)->execute();
 
            \Yii::$app->db->createCommand()
                    ->batchInsert('outcome', ['sub_type_id', 'parent_match_id', 'special_bet_value', 'live_bet', 'created_by', 'created','status', 'winning_outcome'], $params)
                    ->execute();
 
            $transaction->commit();

            return TRUE;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::info("Updating draw no bet outcome approval Exception::" . $e->getMessage());
            print_r($e->getMessage());die();
            //return FALSE; 
        }
    }

}
