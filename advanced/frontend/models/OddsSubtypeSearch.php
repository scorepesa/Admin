<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OddsSubtype;

/**
 * OddsSubtypeSearch represents the model behind the search form about `app\models\OddsSubtype`.
 */
class OddsSubtypeSearch extends OddsSubtype
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odds_subtype_id', 'subtype'], 'integer'],
            [['freetext', 'created'], 'safe'],
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
        $query = OddsSubtype::find();

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
            'odds_subtype_id' => $this->odds_subtype_id,
            'subtype' => $this->subtype,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'freetext', $this->freetext]);

        return $dataProvider;
    }
}
