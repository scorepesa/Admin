<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Withdrawal;

/**
 * WithdrawalSearch represents the model behind the search form about `app\models\Withdrawal`.
 */
class WithdrawalSearch extends Withdrawal {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['withdrawal_id', 'inbox_id', 'number_of_sends'], 'integer'],
            [['msisdn', 'raw_text', 'reference', 'created', 'created_by', 'status', 'provider_reference', 'network'], 'safe'],
            [['amount', 'charge', 'max_withdraw'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Withdrawal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
		'defaultOrder' => [
		    'created' => SORT_DESC,
		]
	    ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'withdrawal_id' => $this->withdrawal_id,
            'inbox_id' => $this->inbox_id,
            'amount' => $this->amount,
            'created' => $this->created,
            'number_of_sends' => $this->number_of_sends,
            'charge' => $this->charge,
            'max_withdraw' => $this->max_withdraw,
            'network' => $this->network
        ]);

        $query->andFilterWhere(['like', 'msisdn', $this->msisdn])
                ->andFilterWhere(['like', 'raw_text', $this->raw_text])
                ->andFilterWhere(['like', 'reference', $this->reference])
                ->andFilterWhere(['like', 'created_by', $this->created_by])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'network', $this->network])
                ->andFilterWhere(['like', 'provider_reference', $this->provider_reference]);

        return $dataProvider;
    }

}
