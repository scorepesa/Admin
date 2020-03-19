<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OutrightOdd;

/**
 * OutrightOddSearch represents the model behind the search form of `app\models\OutrightOdd`.
 */
class OutrightOddSearch extends OutrightOdd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odd_id', 'parent_outright_id', 'betradar_competitor_id', 'status'], 'integer'],
            [['odd_type', 'odd_value', 'special_bet_value', 'created_by', 'created', 'modified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = OutrightOdd::find();

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
            'odd_id' => $this->odd_id,
            'parent_outright_id' => $this->parent_outright_id,
            'betradar_competitor_id' => $this->betradar_competitor_id,
            'status' => $this->status,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'odd_type', $this->odd_type])
            ->andFilterWhere(['like', 'odd_value', $this->odd_value])
            ->andFilterWhere(['like', 'special_bet_value', $this->special_bet_value])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
