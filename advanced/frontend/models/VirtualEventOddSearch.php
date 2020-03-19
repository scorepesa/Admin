<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VirtualEventOdd;

/**
 * VirtualEventOddSearch represents the model behind the search form of `app\models\VirtualEventOdd`.
 */
class VirtualEventOddSearch extends VirtualEventOdd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['v_event_odd_id', 'parent_virtual_id', 'sub_type_id'], 'integer'],
            [['max_bet'], 'number'],
            [['created', 'modified', 'odd_key', 'odd_value', 'odd_alias', 'special_bet_value'], 'safe'],
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
        $query = VirtualEventOdd::find();

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
            'v_event_odd_id' => $this->v_event_odd_id,
            'parent_virtual_id' => $this->parent_virtual_id,
            'sub_type_id' => $this->sub_type_id,
            'max_bet' => $this->max_bet,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'odd_key', $this->odd_key])
            ->andFilterWhere(['like', 'odd_value', $this->odd_value])
            ->andFilterWhere(['like', 'odd_alias', $this->odd_alias])
            ->andFilterWhere(['like', 'special_bet_value', $this->special_bet_value]);

        return $dataProvider;
    }
}
