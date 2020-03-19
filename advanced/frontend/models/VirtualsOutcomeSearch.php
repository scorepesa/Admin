<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VirtualsOutcome;

/**
 * VirtualsOutcomeSearch represents the model behind the search form of `app\models\VirtualsOutcome`.
 */
class VirtualsOutcomeSearch extends VirtualsOutcome
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['v_match_result_id', 'sub_type_id', 'parent_virtual_id', 'live_bet', 'status', 'approved_status'], 'integer'],
            [['special_bet_value', 'created_by', 'created', 'modified', 'approved_by', 'date_approved', 'winning_outcome'], 'safe'],
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
        $query = VirtualsOutcome::find();

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
            'v_match_result_id' => $this->v_match_result_id,
            'sub_type_id' => $this->sub_type_id,
            'parent_virtual_id' => $this->parent_virtual_id,
            'live_bet' => $this->live_bet,
            'created' => $this->created,
            'modified' => $this->modified,
            'status' => $this->status,
            'approved_status' => $this->approved_status,
            'date_approved' => $this->date_approved,
        ]);

        $query->andFilterWhere(['like', 'special_bet_value', $this->special_bet_value])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'approved_by', $this->approved_by])
            ->andFilterWhere(['like', 'winning_outcome', $this->winning_outcome]);

        return $dataProvider;
    }
}
