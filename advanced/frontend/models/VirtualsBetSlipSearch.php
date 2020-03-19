<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VirtualsBetSlip;

/**
 * VirtualsBetSlipSearch represents the model behind the search form of `app\models\VirtualsBetSlip`.
 */
class VirtualsBetSlipSearch extends VirtualsBetSlip
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bet_slip_id', 'parent_match_id', 'bet_id', 'total_games', 'win', 'live_bet', 'status', 'sub_type_id'], 'integer'],
            [['bet_pick', 'special_bet_value', 'created', 'modified'], 'safe'],
            [['odd_value'], 'number'],
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
        $query = VirtualsBetSlip::find();

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
            'bet_slip_id' => $this->bet_slip_id,
            'parent_match_id' => $this->parent_match_id,
            'bet_id' => $this->bet_id,
            'total_games' => $this->total_games,
            'odd_value' => $this->odd_value,
            'win' => $this->win,
            'live_bet' => $this->live_bet,
            'created' => $this->created,
            'modified' => $this->modified,
            'status' => $this->status,
            'sub_type_id' => $this->sub_type_id,
        ]);

        $query->andFilterWhere(['like', 'bet_pick', $this->bet_pick])
            ->andFilterWhere(['like', 'special_bet_value', $this->special_bet_value]);

        return $dataProvider;
    }
}
