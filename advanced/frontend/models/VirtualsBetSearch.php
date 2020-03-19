<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VirtualsBet;

/**
 * VirtualsBetSearch represents the model behind the search form of `app\models\VirtualsBet`.
 */
class VirtualsBetSearch extends VirtualsBet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bet_id', 'profile_id', 'status', 'win'], 'integer'],
            [['bet_message', 'reference', 'created_by', 'created', 'modified'], 'safe'],
            [['total_odd', 'bet_amount', 'possible_win'], 'number'],
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
        $query = VirtualsBet::find();

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
            'bet_id' => $this->bet_id,
            'profile_id' => $this->profile_id,
            'total_odd' => $this->total_odd,
            'bet_amount' => $this->bet_amount,
            'possible_win' => $this->possible_win,
            'status' => $this->status,
            'win' => $this->win,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'bet_message', $this->bet_message])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
