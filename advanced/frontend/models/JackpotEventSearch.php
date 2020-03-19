<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JackpotEvent;

/**
 * JackpotEventSearch represents the model behind the search form about `app\models\JackpotEvent`.
 */
class JackpotEventSearch extends JackpotEvent {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['jackpot_event_id', 'jackpot_type', 'total_games'], 'integer'],
            [['jackpot_name', 'requisite_wins', 'created_by', 'status', 'created', 'modified'], 'safe'],
            [['bet_amount'], 'number'],
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
        $query = JackpotEvent::find();

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
            'jackpot_event_id' => $this->jackpot_event_id,
            'jackpot_type' => $this->jackpot_type,
            'bet_amount' => $this->bet_amount,
            'total_games' => $this->total_games,
            'created' => $this->created,
            'modified' => $this->modified,
            'requisite_wins' => $this->requisite_wins
        ]);

        $query->andFilterWhere(['like', 'jackpot_name', $this->jackpot_name])
                ->andFilterWhere(['like', 'created_by', $this->created_by])
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

}
