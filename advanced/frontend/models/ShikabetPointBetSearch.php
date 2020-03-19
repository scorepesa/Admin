<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ScorepesaPointBet;

/**
 * ScorepesaPointBetSearch represents the model behind the search form of `app\models\ScorepesaPointBet`.
 */
class ScorepesaPointBetSearch extends ScorepesaPointBet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scorepesa_point_bet_id', 'bet_id', 'scorepesa_point_trx_id'], 'integer'],
            [['points', 'amount'], 'number'],
            [['created_by', 'created', 'modified'], 'safe'],
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
        $query = ScorepesaPointBet::find();

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
            'scorepesa_point_bet_id' => $this->scorepesa_point_bet_id,
            'bet_id' => $this->bet_id,
            'scorepesa_point_trx_id' => $this->scorepesa_point_trx_id,
            'points' => $this->points,
            'amount' => $this->amount,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
