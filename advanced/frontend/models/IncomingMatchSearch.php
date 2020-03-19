<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IncomingMatch;

/**
 * IncomingMatchSearch represents the model behind the search form about `app\models\IncomingMatch`.
 */
class IncomingMatchSearch extends IncomingMatch {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['incoming_match_id', 'active'], 'integer'],
            [['parent_match_id', 'sport_name', 'competition_name', 'competition_category', 'start_time', 'end_time', 'home_team', 'away_team', 'created'], 'safe'],
            [['home_odd', 'neutral_odd', 'away_odd'], 'number'],
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
        $query = IncomingMatch::find()->where(["active" => 1]);

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
            'incoming_match_id' => $this->incoming_match_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'home_odd' => $this->home_odd,
            'neutral_odd' => $this->neutral_odd,
            'away_odd' => $this->away_odd,
            'active' => $this->active,
            'created' => $this->created,
            'active' => "1",
        ]);

        $query->andFilterWhere(['like', 'parent_match_id', $this->parent_match_id])
                ->andFilterWhere(['like', 'sport_name', $this->sport_name])
                ->andFilterWhere(['like', 'competition_name', $this->competition_name])
                ->andFilterWhere(['like', 'competition_category', $this->competition_category])
                ->andFilterWhere(['like', 'home_team', $this->home_team])
                ->andFilterWhere(['like', 'away_team', $this->away_team]);

        return $dataProvider;
    }

}
