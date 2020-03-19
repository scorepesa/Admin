<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OutrightOutcome;

/**
 * OutrightOutcomeSearch represents the model behind the search form of `app\models\OutrightOutcome`.
 */
class OutrightOutcomeSearch extends OutrightOutcome
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['outcome_id', 'parent_outright_id', 'betradar_competitor_id', 'status'], 'integer'],
            [['odd_type', 'special_bet_value', 'outcome', 'created_by', 'created', 'modified'], 'safe'],
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
        $query = OutrightOutcome::find();

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
            'outcome_id' => $this->outcome_id,
            'parent_outright_id' => $this->parent_outright_id,
            'betradar_competitor_id' => $this->betradar_competitor_id,
            'status' => $this->status,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'odd_type', $this->odd_type])
            ->andFilterWhere(['like', 'special_bet_value', $this->special_bet_value])
            ->andFilterWhere(['like', 'outcome', $this->outcome])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
