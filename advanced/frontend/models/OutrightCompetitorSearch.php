<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OutrightCompetitor;

/**
 * OutrightCompetitorSearch represents the model behind the search form of `app\models\OutrightCompetitor`.
 */
class OutrightCompetitorSearch extends OutrightCompetitor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['competitor_id', 'parent_outright_id', 'betradar_competitor_id', 'betradar_super_id', 'status', 'priority'], 'integer'],
            [['competitor_name', 'created_by', 'created', 'modified'], 'safe'],
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
        $query = OutrightCompetitor::find();

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
            'competitor_id' => $this->competitor_id,
            'parent_outright_id' => $this->parent_outright_id,
            'betradar_competitor_id' => $this->betradar_competitor_id,
            'betradar_super_id' => $this->betradar_super_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'competitor_name', $this->competitor_name])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
