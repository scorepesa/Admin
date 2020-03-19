<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OddType;

/**
 * OddTypeSearch represents the model behind the search form about `app\models\OddType`.
 */
class OddTypeSearch extends OddType {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['bet_type_id', 'sub_type_id'], 'integer'],
            [['name', 'created_by', 'created', 'modified'], 'safe'],
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
        $query = OddType::find();
        $query->join('inner join', 'outcome', 
            '(outcome.sub_type_id=odd_type.sub_type_id and outcome.parent_match_id = odd_type.parent_match_id) ');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'bet_type_id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bet_type_id' => $this->bet_type_id,
            'created' => $this->created,
            'modified' => $this->modified,
            'odd_type.sub_type_id' => $this->sub_type_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'created_by', $this->created_by]);


        return $dataProvider;
    }

}
