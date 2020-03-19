<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MpesaTransaction;

/**
 * MpesaTransactionSearch represents the model behind the search form about `app\models\MpesaTransaction`.
 */
class MpesaTransactionSearch extends MpesaTransaction {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['mpesa_transaction_id', 'mpesa_customer_id', 'msisdn', 'business_number'], 'integer'],
            [['transaction_time', 'message', 'account_no', 'mpesa_code', 'mpesa_sender', 'enc_params', 'created', 'modified'], 'safe'],
            [['mpesa_amt'], 'number'],
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
        $query = MpesaTransaction::find();

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
            'mpesa_transaction_id' => $this->mpesa_transaction_id,
            'msisdn' => $this->msisdn,
            'transaction_time' => $this->transaction_time,
            'mpesa_amt' => $this->mpesa_amt,
            'business_number' => $this->business_number,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'account_no', $this->account_no])
                ->andFilterWhere(['like', 'mpesa_code', $this->mpesa_code])
                ->andFilterWhere(['like', 'mpesa_sender', $this->mpesa_sender])
                ->andFilterWhere(['like', 'enc_params', $this->enc_params]);

        return $dataProvider;
    }

}
