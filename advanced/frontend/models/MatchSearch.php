<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Match;
use app\models\BetSlip;

/**
 * MatchSearch represents the model behind the search form about `app\models\Match`.
 */
class MatchSearch extends Match {

    public $competitionName;
    public $gameId;
    public $home_team;
    public $away_team;
    public $parent_match_id;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['match_id', 'competition_id', 'status', 'completed'], 'integer'],
            [['parent_match_id', 'competitionName', 'home_team', 'away_team',
            'start_time', 'game_id', 'gameId', 'home_team', 'away_team',
            'bet_closure', 'created_by', 'created', 'modified', 'result'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = MatchMaster::find();
        $query->join('inner join', 'competition', 'competition.competition_id = match.competition_id');
//        $query->join('inner join', 'outcome', 'outcome.parent_match_id=match.parent_match_id');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'match_id' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'match_id' => $this->match_id,
            'game_id' => $this->gameId,
            'game_id' => $this->game_id,
            'parent_match_id' => $this->parent_match_id,
            'start_time' => $this->start_time,
            'competition.competition_name' => $this->competitionName,
            'status' => $this->status,
            'bet_closure' => $this->bet_closure,
            'created' => $this->created,
            'modified' => $this->modified,
            'completed' => $this->completed,
        ]);

        $query->andFilterWhere(['like', 'home_team', $this->home_team])
                ->andFilterWhere(['like', 'away_team', $this->away_team])
                ->andFilterWhere(['like', 'competition.competition_name', $this->competitionName])
                ->andFilterWhere(['like', 'created_by', $this->created_by])
                ->andFilterWhere(['like', 'result', $this->result]);
//            ->andFilterWhere(['like', 'bet_result', $this->bet_result]);

        return $dataProvider;
    }

    public function searchSingleResulting($params) {
        $subQuery = (new \yii\db\Query())->select('MAX(bet_id)-1000000 as mId')->from('bet')->all();
        $minID = $subQuery[0]['mId'];

        $query = BetSlipMaster::find()->select('bet_slip.created, bet_slip.parent_match_id, bet_slip.sub_type_id,odd_type.live_bet,outcome.live_bet,bet_slip.live_bet');
        $query->join('inner join', 'match', '(bet_slip.parent_match_id = match.parent_match_id)');
        $query->join('inner join', 'odd_type', 'bet_slip.sub_type_id = odd_type.sub_type_id');
        $query->join('left join', 'outcome', '(bet_slip.parent_match_id = outcome.parent_match_id and 
             outcome.sub_type_id = bet_slip.sub_type_id
             and outcome.special_bet_value = bet_slip.special_bet_value)');
        $query->andFilterWhere(['>', 'bet_slip.bet_id', $minID]);
        $query->where(['match_result_id' => null]);
        $query->andWhere(['<', 'match.start_time', new \yii\db\Expression('NOW() - INTERVAL 2 HOUR')]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'parent_match_id' => SORT_ASC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'start_time' => $this->start_time,
            'competition.competition_name' => $this->competitionName,
            'bet_slip.status' => $this->status,
            'bet_closure' => $this->bet_closure,
            // 'bet_slip.created' => $this->created,
            'bet_slip.modified' => $this->modified,
            'completed' => $this->completed,
        ]);

        $query->andFilterWhere(['like', 'match.home_team', $this->home_team])
                ->andFilterWhere(['like', 'match.away_team', $this->away_team])
                ->andFilterWhere(['like', 'match.game_id', $this->game_id])
                ->andFilterWhere(['like', 'bet_slip.created', $this->created])
                ->andFilterWhere(['like', 'match.created_by', $this->created_by])
                ->andFilterWhere(['like', 'match.result', $this->result])
                ->andFilterWhere(['like', 'competition.competition_name', $this->competitionName]);
        $query->groupBy(['bet_slip.parent_match_id', 'bet_slip.sub_type_id']);
        //die( print_r($query->createCommand()->getRawSql()));
        return $dataProvider;
    }

    public function searchResulting($params) {
        $query = BetSlip::find()->select('bet_slip.bet_slip_id, bet_slip.created, bet_slip.parent_match_id, bet_slip.sub_type_id');
        #$query = BetSlip::findBySql("select bet_slip.bet_slip_id, bet_slip.created, bet_slip.parent_match_id, bet_slip.sub_type_id from bet_slip inner join `match` on (bet_slip.parent_match_id = match.parent_match_id) inner join odd_type on bet_slip.sub_type_id = odd_type.sub_type_id left join outcome on (bet_slip.parent_match_id = outcome.parent_match_id and outcome.sub_type_id = bet_slip.sub_type_id and outcome.special_bet_value = bet_slip.special_bet_value) where match_result_id is null and bet_slip.status = 1 and match.start_time < NOW() - INTERVAL 2 HOUR and match.start_time > NOW() - INTERVAL 5 DAY"); 

        #$query = BetSlip::findBySql("select bet_slip.bet_slip_id, bet_slip.created, bet_slip.parent_match_id, bet_slip.sub_type_id from bet_slip limit 5");
        $query->join('inner join', 'match', '(bet_slip.parent_match_id = match.parent_match_id)');
        $query->join('inner join', 'odd_type', 'bet_slip.sub_type_id = odd_type.sub_type_id');
        $query->join('left join', 'outcome', '(bet_slip.parent_match_id = outcome.parent_match_id and 
             outcome.sub_type_id = bet_slip.sub_type_id
             and outcome.special_bet_value = bet_slip.special_bet_value)');
        //$query->where(['match_result_id' => null]);
        $query->where(['match_result_id' => null, 'bet_slip.status' => 1]);
        $query->andFilterWhere(['<', 'match.start_time', new \yii\db\Expression('NOW() - INTERVAL 2 HOUR')]);
        $query->andFilterWhere(['>=', 'match.start_time', new \yii\db\Expression('NOW() - INTERVAL 2 DAY')]);
        
        /* $query->orderBy([
          'match.start_time' => SORT_DESC
          ]); */

        /*echo $query->createCommand()->getRawSql();
        die(); */

       /*
        $max = BetSlip::find()->select('max(bet_slip_id)')->scalar();
        $id = $max-10000000;

        $query->join('inner join', 'match', "(bet_slip.parent_match_id = match.parent_match_id and bet_slip.bet_slip_id > $id)");
        $query->join('inner join', 'odd_type', "bet_slip.sub_type_id = odd_type.sub_type_id and bet_slip.bet_slip_id > $id");
        $query->join('left join', 'outcome', "(bet_slip.parent_match_id = outcome.parent_match_id and 
             outcome.sub_type_id = bet_slip.sub_type_id
             and outcome.special_bet_value = bet_slip.special_bet_value and bet_slip.bet_slip_id > $id)");
        //$query->where(['>', 'bet_slip.bet_slip_id', $max-6000000]);
        $query->andWhere(['match_result_id' => null, 'bet_slip.status' => 1]);
        $query->andFilterWhere(['<', 'match.start_time', new \yii\db\Expression('NOW() - INTERVAL 2 HOUR')]);
        */


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 40,
            ],
            /*'sort' => [
                'defaultOrder' => [
                    'parent_match_id' => SORT_ASC
                ]
            ],*/
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'start_time' => $this->start_time,
            'competition.competition_name' => $this->competitionName,
            'bet_slip.status' => $this->status,
            'bet_closure' => $this->bet_closure,
            'completed' => $this->completed,
            'match.game_id' => $this->gameId,
            'match.home_team' => $this->home_team,
            'match.away_team' => $this->away_team,
        ]);

        $query->groupBy(['match.parent_match_id', 'odd_type.sub_type_id']);
//        die(print_r($query->createCommand()->getRawSql()));
        return $dataProvider;
    }

    public function resultApproval($params) {
       
        $UpLimit = (new \yii\db\Query())->select('match_result_id')
                ->where(['<', 'created', new \yii\db\Expression('NOW() - INTERVAL 4 DAY')])
                ->from('outcome')
                ->orderBy([
                    'match_result_id' => SORT_DESC])
                ->one();

        $upperid = $UpLimit['match_result_id'];
        

        $query = MatchMaster::find()->select('game_id, home_team, away_team,ht_score,ft_score,match.parent_match_id, outcome.created_by');
        #$query = MatchMaster::findBySql("select game_id, home_team, away_team,ht_score,ft_score,match.parent_match_id from `match` limit 1");

        $query->join('right join', 'outcome', '(outcome.parent_match_id = match.parent_match_id)');
        $query->where(['outcome.approved_status' => 0]);
        //$query->andWhere(['>', 'outcome.match_result_id', $upperid]);
        $query->andWhere(['<>', 'outcome.created_by', "BETRADAR"]);
        $query->andWhere(['<>', 'outcome.created_by', "BETRADAR-LIVE"]);
        $query->andWhere(['<>', 'outcome.sub_type_id', -1]);
        $query->andWhere(['is not', 'match.parent_match_id', null]);
        $query->orderBy([
            'outcome.match_result_id' => SORT_DESC,
        ]);

        /*echo $query->createCommand()->getRawSql();
          die(); */

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            /*'sort' => [
                'defaultOrder' => [
                ]
            ]*/
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'match.start_time' => $this->start_time,
            'bet_slip.status' => $this->status,
            'match.bet_closure' => $this->bet_closure,
            'match.game_id' => $this->game_id,
            'match.parent_match_id' => $this->parent_match_id,
        ]);

        $query->andFilterWhere(['like', 'match.home_team', $this->home_team])
                ->andFilterWhere(['like', 'match.away_team', $this->away_team]);

        #$query->groupBy(['outcome.parent_match_id', 'outcome.sub_type_id']);
        
        $query->groupBy(['outcome.parent_match_id']);
 
        //die( print_r($query->createCommand()->getRawSql()));
        return $dataProvider;
    }

}
