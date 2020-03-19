<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JackpotBet;

/**
 * JackpotBetSearch represents the model behind the search form about `app\models\JackpotBet`.
 */
class JackpotBetSearch extends JackpotBet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jackpot_bet_id', 'bet_id', 'jackpot_event_id'], 'integer'],
            [['status', 'created', 'modified'], 'safe'],
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
        $query = JackpotBet::find();

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
            'jackpot_bet_id' => $this->jackpot_bet_id,
            'bet_id' => $this->bet_id,
            'jackpot_event_id' => $this->jackpot_event_id,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
