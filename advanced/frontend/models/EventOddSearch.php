<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EventOdd;

/**
 * MatchBetSearch represents the model behind the search form about `app\models\EventOdd`.
 */
class EventOddSearch extends EventOdd {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['event_odd_id', 'parent_match_id', 'sub_type_id'], 'integer'],
            [['max_bet', 'odd_key', 'odd_value'], 'number'],
            [['created', 'modified'], 'safe'],
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
        $query = EventOdd::find();

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
            'event_odd_id' => $this->event_odd_id,
            'parent_match_id' => $this->parent_match_id,
            'sub_type_id' => $this->sub_type_id,
            'max_bet' => $this->max_bet,
            'odd_key' => $this->odd_key,
            'odd_value' => $this->odd_value,
            'odd_alias' => $this->odd_alias,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);


        return $dataProvider;
    }

}
