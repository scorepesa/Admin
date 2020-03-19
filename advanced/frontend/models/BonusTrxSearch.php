<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BonusTrx;

/**
 * BonusTrxSearch represents the model behind the search form about `app\models\BonusTrx`.
 */
class BonusTrxSearch extends BonusTrx
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'profile_id', 'iscredit', 'profile_bonus_id'], 'integer'],
            [['account', 'reference', 'created_by', 'created', 'modified'], 'safe'],
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
        $query = BonusTrx::find();

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
            'profile_id' => $this->profile_id,
            'iscredit' => $this->iscredit,
            'amount' => $this->amount,
            'created' => $this->created,
            'modified' => $this->modified,
            'profile_bonus_id' => $this->profile_bonus_id,
        ]);

        $query->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
