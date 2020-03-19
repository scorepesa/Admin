<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JpbonusAward;

/**
 * JpbonusAwardSearch represents the model behind the search form about `frontend\models\JpbonusAward`.
 */
class JpbonusAwardSearch extends JpbonusAward
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jackpot_event_id', 'scorepesa_points_bonus'], 'integer'],
            [['jackpot_bonus'], 'number'],
            [['approved_by', 'created_by', 'created', 'modified'], 'safe'],
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
        $query = JpbonusAward::find();

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
            'jackpot_event_id' => $this->jackpot_event_id,
            'jackpot_bonus' => $this->jackpot_bonus,
            'scorepesa_points_bonus' => $this->scorepesa_points_bonus,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
