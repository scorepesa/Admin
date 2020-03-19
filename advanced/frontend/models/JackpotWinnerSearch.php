<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JackpotWinner;

/**
 * JackpotWinnerSearch represents the model behind the search form about `app\models\JackpotWinner`.
 */
class JackpotWinnerSearch extends JackpotWinner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jackpot_winner_id', 'win_amount', 'bet_id', 'jackpot_event_id', 'total_games_correct', 'status'], 'integer'],
            [['created_by', 'created', 'modified'], 'safe'],
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
        $query = JackpotWinner::find();

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
            'jackpot_winner_id' => $this->jackpot_winner_id,
            'win_amount' => $this->win_amount,
            'bet_id' => $this->bet_id,
            'jackpot_event_id' => $this->jackpot_event_id,
            'total_games_correct' => $this->total_games_correct,
            'status' => $this->status,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
