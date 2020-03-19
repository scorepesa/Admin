<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SevenAggregatorRequest;

/**
 * SevenAggregatorRequestSearch represents the model behind the search form of `app\models\SevenAggregatorRequest`.
 */
class SevenAggregatorRequestSearch extends SevenAggregatorRequest {

    public $profileName;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'amount_small', 'status'], 'integer'],
            [['amount'], 'number'],
            [['request_name', 'profileName', 'currency', 'user', 'payment_strategy', 'transactionType', 'payment_id', 'transaction_id', 'source_id', 'reference_id', 'tp_token', 'ticket_info', 'security_hash', 'club_uuid', 'aggregator_status', 'created_by', 'date_created', 'date_modified'], 'safe'],
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
        $query = SevenAggregatorRequest::find();
        $query->join('inner join', 'profile', 'profile.profile_id = seven_aggregator_request.user');
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
            'id' => $this->id,
            'amount' => $this->amount,
            'amount_small' => $this->amount_small,
            'status' => $this->status,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'request_name', $this->request_name])
                ->andFilterWhere(['like', 'currency', $this->currency])
                ->andFilterWhere(['like', 'profile.msisdn', $this->profileName])
                ->andFilterWhere(['like', 'payment_strategy', $this->payment_strategy])
                ->andFilterWhere(['like', 'transactionType', $this->transactionType])
                ->andFilterWhere(['like', 'payment_id', $this->payment_id])
                ->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
                ->andFilterWhere(['like', 'source_id', $this->source_id])
                ->andFilterWhere(['like', 'reference_id', $this->reference_id])
                ->andFilterWhere(['like', 'tp_token', $this->tp_token])
                ->andFilterWhere(['like', 'ticket_info', $this->ticket_info])
                ->andFilterWhere(['like', 'security_hash', $this->security_hash])
                ->andFilterWhere(['like', 'club_uuid', $this->club_uuid])
                ->andFilterWhere(['like', 'aggregator_status', $this->aggregator_status])
                ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }

}
