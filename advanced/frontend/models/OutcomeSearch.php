<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Outcome;

/**
 * OutcomeSearch represents the model behind the search form about `app\models\Outcome`.
 */
class OutcomeSearch extends Outcome {

    public $homeTeam;
    public $awayTeam;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['match_result_id', 'sub_type_id', 'parent_match_id', 'status'], 'integer'],
            [['created_by', 'created', 'modified', 'winning_outcome', 'homeTeam', 'awayTeam', 'live_bet'], 'safe'],
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
        $query = Outcome::find();
        $live = isset($params['OutcomeSearch']['live_bet']) ? $params['OutcomeSearch']['live_bet'] : 0;
        $match_tbl = $live == 0 ? "match" : "live_match";
        $query->join('inner join', $match_tbl, $match_tbl . '.parent_match_id=outcome.parent_match_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['match_result_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'match_result_id' => $this->match_result_id,
            'sub_type_id' => $this->sub_type_id,
            'outcome.parent_match_id' => $this->parent_match_id,
            'created' => $this->created,
            'modified' => $this->modified,
            'status' => $this->status,
            'outcome.live_bet' => $this->live_bet
        ]);

        $query->andFilterWhere(['like', 'outcome.created_by', $this->created_by])
                ->andFilterWhere(['like', 'home_team', $this->homeTeam])
                ->andFilterWhere(['like', 'away_team', $this->awayTeam])
                ->andFilterWhere(['like', 'winning_outcome', $this->winning_outcome]);
        /* print_r($query->createCommand()->getRawSql());
          die(); */
        return $dataProvider;
    }

}
