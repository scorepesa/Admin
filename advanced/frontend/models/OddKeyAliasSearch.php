<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OddKeyAlias;

/**
 * OddKeyAliasSearch represents the model behind the search form of `app\models\OddKeyAlias`.
 */
class OddKeyAliasSearch extends OddKeyAlias {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['odd_key_alias_id', 'sub_type_id'], 'integer'],
            [['odd_key', 'odd_key_alias', 'special_bet_value'], 'safe'],
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
        $query = OddKeyAlias::find();
        $query->join('inner join', 'odd_type', 'odd_type.sub_type_id=odd_key_alias.sub_type_id');

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
            'odd_key_alias_id' => $this->odd_key_alias_id,
            'odd_type.sub_type_id' => $this->sub_type_id,
            'odd_type.name' => $this->subTypeName,
            'odd_key' => $this->odd_key,
            'odd_key_alias' => $this->odd_key_alias,
            'odd_key_alias' => $this->special_bet_value
        ]);

        $query->andFilterWhere(['like', 'odd_key', $this->odd_key])
                ->andFilterWhere(['like', 'odd_key_alias', $this->odd_key_alias])
                ->andFilterWhere(['like', 'special_bet_value', $this->special_bet_value])
                ->andFilterWhere(['like', 'odd_type.name', $this->subTypeName])
                ->andFilterWhere(['like', 'odd_key', $this->odd_key])
                ->andFilterWhere(['like', 'odd_key_alias', $this->odd_key_alias]);

        return $dataProvider;
    }

}
