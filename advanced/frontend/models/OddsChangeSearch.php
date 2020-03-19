<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OddsChange;

/**
 * OddsChangeSearch represents the model behind the search form about `app\models\OddsChange`.
 */
class OddsChangeSearch extends OddsChange
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odds_change_id'], 'integer'],
            [['parent_match_id', 'subtype', 'key', 'value', 'match_time', 'score', 'bet_status', 'created'], 'safe'],
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
        $query = OddsChange::find();

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
            'odds_change_id' => $this->odds_change_id,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'parent_match_id', $this->parent_match_id])
            ->andFilterWhere(['like', 'subtype', $this->subtype])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'match_time', $this->match_time])
            ->andFilterWhere(['like', 'score', $this->score])
            ->andFilterWhere(['like', 'bet_status', $this->bet_status]);

        return $dataProvider;
    }
}
