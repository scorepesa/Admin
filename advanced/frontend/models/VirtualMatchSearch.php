<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VirtualMatch;

/**
 * VirtualMatchSearch represents the model behind the search form of `app\models\VirtualMatch`.
 */
class VirtualMatchSearch extends VirtualMatch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['v_match_id', 'parent_virtual_id', 'competition_id', 'status', 'instance_id', 'completed', 'priority'], 'integer'],
            [['home_team', 'away_team', 'start_time', 'bet_closure', 'created_by', 'created', 'modified', 'result', 'ht_score', 'ft_score'], 'safe'],
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
        $query = VirtualMatch::find();

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
            'v_match_id' => $this->v_match_id,
            'parent_virtual_id' => $this->parent_virtual_id,
            'start_time' => $this->start_time,
            'competition_id' => $this->competition_id,
            'status' => $this->status,
            'instance_id' => $this->instance_id,
            'bet_closure' => $this->bet_closure,
            'created' => $this->created,
            'modified' => $this->modified,
            'completed' => $this->completed,
            'priority' => $this->priority,
        ]);

        $query->andFilterWhere(['like', 'home_team', $this->home_team])
            ->andFilterWhere(['like', 'away_team', $this->away_team])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'ht_score', $this->ht_score])
            ->andFilterWhere(['like', 'ft_score', $this->ft_score]);

        return $dataProvider;
    }
}
