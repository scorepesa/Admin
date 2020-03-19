<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccountFreeze;

/**
 * AccountFreezeSearch represents the model behind the search form about `app\models\AccountFreeze`.
 */
class AccountFreezeSearch extends AccountFreeze
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_freeze_id', 'status'], 'integer'],
            [['msisdn', 'created', 'modified'], 'safe'],
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
        $query = AccountFreeze::find();

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
            'account_freeze_id' => $this->account_freeze_id,
            'status' => $this->status,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'msisdn', $this->msisdn]);

        return $dataProvider;
    }
}
