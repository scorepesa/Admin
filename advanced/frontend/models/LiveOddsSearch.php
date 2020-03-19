<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LiveOdds;

/**
 * LiveOddsSearch represents the model behind the search form about `app\models\LiveOdds`.
 */
class LiveOddsSearch extends LiveOdds {

    /**
     * @inheritdoc
     */
    public function rules() {

        return [
            [['live_odds_change_id'], 'integer'],
            [['parent_match_id', 'created', 'subtype', 'key', 'value', 'match_time', 'score', 'bet_status'], 'safe'],
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
        $query = LiveOdds::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'live_odds_change_id' => $this->live_odds_change_id,
            'parent_match_id' => $this->parent_match_id,
            'subtype' => $this->subtype,
            'key' => $this->key,
            'value' => $this->value,
            'match_time' => $this->match_time,
            'score' => $this->score,
            'bet_status' => $this->bet_status,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'parent_match_id', $this->parent_match_id]);

        return $dataProvider;
    }

}
