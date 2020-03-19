<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BleagueEventOdd;

/**
 * BleagueEventOddSearch represents the model behind the search form of `app\models\BleagueEventOdd`.
 */
class BleagueEventOddSearch extends BleagueEventOdd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_odd_id', 'parent_match_id', 'sub_type_id', 'status', 'approved_by', 'winning_outcome'], 'integer'],
            [['max_bet'], 'number'],
            [['created_by', 'created', 'modified', 'odd_key', 'odd_value', 'special_bet_value', 'odd_alias', 'approved_by', 'winning_outcome'], 'safe'],
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
        //$query = BleagueEventOdd::find();

        $query = BleagueEventOdd::find()->where(['=', 'status', 1]);

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
            'event_odd_id' => $this->event_odd_id,
            'parent_match_id' => $this->parent_match_id,
            'sub_type_id' => $this->sub_type_id,
            'max_bet' => $this->max_bet,
            'created' => $this->created,
            'modified' => $this->modified,
            'status' => $this->status,
            'approved_by' => $this->approved_by,
            'winning_outcome' => $this->winning_outcome,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'odd_key', $this->odd_key])
            ->andFilterWhere(['like', 'odd_value', $this->odd_value])
            ->andFilterWhere(['like', 'special_bet_value', $this->special_bet_value])
            ->andFilterWhere(['like', 'odd_alias', $this->odd_alias])
            ->andFilterWhere(['like', 'approved_by', $this->approved_by])
            ->andFilterWhere(['like', 'winning_outcome', $this->winning_outcome]);

        return $dataProvider;
    }

    public function processed($params)
    {
        //$query = BleagueEventOdd::find();

        $query = BleagueEventOdd::find()->where(['=', 'status', 0]);

        // add conditions that should always apply here

        $dataProvider1 = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider1;
        }

       $query->andFilterWhere([
            'event_odd_id' => $this->event_odd_id,
            'parent_match_id' => $this->parent_match_id,
            'sub_type_id' => $this->sub_type_id,
            'max_bet' => $this->max_bet,
            'created' => $this->created,
            'modified' => $this->modified,
            'status' => $this->status,
            'approved_by' => $this->approved_by,
            'winning_outcome' => $this->winning_outcome,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'odd_key', $this->odd_key])
            ->andFilterWhere(['like', 'odd_value', $this->odd_value])
            ->andFilterWhere(['like', 'special_bet_value', $this->special_bet_value])
            ->andFilterWhere(['like', 'odd_alias', $this->odd_alias])
            ->andFilterWhere(['like', 'approved_by', $this->approved_by])
            ->andFilterWhere(['like', 'winning_outcome', $this->winning_outcome]);


        return $dataProvider1;
    }
}
