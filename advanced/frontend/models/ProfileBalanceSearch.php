<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfileBalance;

/**
 * ProfileBalanceSearch represents the model behind the search form about `app\models\ProfileBalance`.
 */
class ProfileBalanceSearch extends ProfileBalance {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['profile_balance_id', 'profile_id', 'transaction_id'], 'integer'],
            [['balance', 'bonus_balance'], 'number'],
            [['created', 'modified', 'bonus_balance'], 'safe'],
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
        $query = ProfileBalance::find();

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
            'profile_balance_id' => $this->profile_balance_id,
            'profile_id' => $this->profile_id,
            'balance' => $this->balance,
            'transaction_id' => $this->transaction_id,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        return $dataProvider;
    }

}
