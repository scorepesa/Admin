<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfileSettings;

/**
 * ProfileSettingsSearch represents the model behind the search form about `app\models\ProfileSettings`.
 */
class ProfileSettingsSearch extends ProfileSettings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_setting_id', 'profile_id', 'balance', 'status', 'verification_code'], 'integer'],
            [['name', 'reference_id', 'created_at', 'updated_at', 'password'], 'safe'],
            [['max_stake'], 'number'],
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
        $query = ProfileSettings::find();

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
            'profile_setting_id' => $this->profile_setting_id,
            'profile_id' => $this->profile_id,
            'balance' => $this->balance,
            'status' => $this->status,
            'verification_code' => $this->verification_code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'max_stake' => $this->max_stake,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'reference_id', $this->reference_id])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
