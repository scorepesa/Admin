<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ShopWithdrawals;

/**
 * ShopWithdrawalsSearch represents the model behind the search form of `app\models\ShopWithdrawals`.
 */
class ShopWithdrawalsSearch extends ShopWithdrawals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['withdrawal_id', 'status'], 'integer'],
            [['msisdn', 'created_by', 'approved_by', 'created', 'modified'], 'safe'],
            [['amount'], 'number'],
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
        $query = ShopWithdrawals::find();

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
            'withdrawal_id' => $this->withdrawal_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'msisdn', $this->msisdn])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'approved_by', $this->approved_by]);

        return $dataProvider;
    }
}
