<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfileBonus;

/**
 * ProfileBonusSearch represents the model behind the search form about `app\models\ProfileBonus`.
 */
class ProfileBonusSearch extends ProfileBonus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_bonus_id', 'profile_id'], 'integer'],
            [['referred_msisdn', 'status', 'expiry_date', 'date_created', 'updated'], 'safe'],
            [['bonus_amount'], 'number'],
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
        $query = ProfileBonus::find();

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
            'profile_bonus_id' => $this->profile_bonus_id,
            'profile_id' => $this->profile_id,
            'bonus_amount' => $this->bonus_amount,
            'expiry_date' => $this->expiry_date,
            'date_created' => $this->date_created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'referred_msisdn', $this->referred_msisdn])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
