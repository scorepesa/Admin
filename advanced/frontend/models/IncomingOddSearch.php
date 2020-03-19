<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IncomingOdd;

/**
 * IncomingOddSearch represents the model behind the search form about `app\models\IncomingOdd`.
 */
class IncomingOddSearch extends IncomingOdd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['incoming_odd_id'], 'integer'],
            [['parent_match_id', 'created'], 'safe'],
            [['home_odd', 'neutral_odd', 'away_odd'], 'number'],
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
        $query = IncomingOdd::find();

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
            'incoming_odd_id' => $this->incoming_odd_id,
            'home_odd' => $this->home_odd,
            'neutral_odd' => $this->neutral_odd,
            'away_odd' => $this->away_odd,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'parent_match_id', $this->parent_match_id]);

        return $dataProvider;
    }
}
