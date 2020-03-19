<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VirtualCompetition;

/**
 * VirtualCompetitionSearch represents the model behind the search form of `app\models\VirtualCompetition`.
 */
class VirtualCompetitionSearch extends VirtualCompetition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['v_competition_id', 'status', 'category_id', 'sport_id', 'priority'], 'integer'],
            [['competition_name', 'category', 'created_by', 'created', 'modified'], 'safe'],
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
        $query = VirtualCompetition::find();

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
            'v_competition_id' => $this->v_competition_id,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'sport_id' => $this->sport_id,
            'created' => $this->created,
            'modified' => $this->modified,
            'priority' => $this->priority,
            'max_stake' => $this->max_stake,
        ]);

        $query->andFilterWhere(['like', 'competition_name', $this->competition_name])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
