<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Competition;

/**
 * CompetitionSearch represents the model behind the search form of `app\models\Competition`.
 */
class CompetitionSearch extends Competition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['competition_id', 'betradar_competition_id', 'category_id', 'status', 'sport_id', 'priority', 'ussd_priority'], 'integer'],
            [['competition_name', 'category', 'created_by', 'created', 'modified', 'alias'], 'safe'],
            [['max_stake'], 'number'],
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
        $query = Competition::find();

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
            'competition_id' => $this->competition_id,
            'betradar_competition_id' => $this->betradar_competition_id,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'sport_id' => $this->sport_id,
            'created' => $this->created,
            'modified' => $this->modified,
            'priority' => $this->priority,
            'ussd_priority' => $this->ussd_priority,
            'max_stake' => $this->max_stake,
        ]);

        $query->andFilterWhere(['like', 'competition_name', $this->competition_name])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
