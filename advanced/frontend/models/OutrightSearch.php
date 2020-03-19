<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Outright;

/**
 * OutrightSearch represents the model behind the search form of `app\models\Outright`.
 */
class OutrightSearch extends Outright {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['outright_id', 'parent_outright_id', 'competition_id', 'status', 'instance_id', 'completed', 'priority'], 'integer'],
            [['event_name', 'event_date', 'event_end_date', 'game_id', 'created_by', 'created', 'modified', 'result'], 'safe'],
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
        $query = Outright::find();

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
            'outright_id' => $this->outright_id,
            'parent_outright_id' => $this->parent_outright_id,
            'event_date' => $this->event_date,
            'event_end_date' => $this->event_end_date,
            'competition_id' => $this->competition_id,
            'status' => $this->status,
            'instance_id' => $this->instance_id,
            'created' => $this->created,
            'modified' => $this->modified,
            'completed' => $this->completed,
            'priority' => $this->priority,
        ]);

        $query->andFilterWhere(['like', 'event_name', $this->event_name])
                ->andFilterWhere(['like', 'game_id', $this->game_id])
                ->andFilterWhere(['like', 'created_by', $this->created_by])
                ->andFilterWhere(['like', 'result', $this->result]);

        return $dataProvider;
    }

    public function searchResulting($params) {
        $query = Outright::find()->select('outright.outright_id, outright.event_date, outright.parent_outright_id, outright_odd.odd_type');
        $query->join('inner join', 'bet_slip', '(outright.parent_outright_id=bet_slip.parent_match_id)');
        $query->join('inner join', 'outright_odd', '(outright.parent_outright_id=outright_odd.parent_outright_id)');
//        $query->join('inner join', 'outright_competitor', '(outright.parent_outright_id=outright_competitor.parent_outright_id)');
        $query->join('left join', 'outright_outcome', '(outright_outcome.parent_outright_id=outright_odd.parent_outright_id and outright_outcome.odd_type=outright_odd.odd_type and outright_outcome.special_bet_value=outright_odd.special_bet_value)');
        $query->where(['outright_outcome.outcome_id' => null]);
        $query->where(['outright_outcome.outcome_id' => null, 'bet_slip.status' => 1]);
        $query->andFilterWhere(['<', 'outright.event_date', new \yii\db\Expression('NOW() - INTERVAL 2 HOUR')]);
        $query->andFilterWhere(['>=', 'outright.event_date', new \yii\db\Expression('NOW() - INTERVAL 85 DAY')]);

        /* echo $query->createCommand()->getRawSql();
          die(); */

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'parent_outright_id' => SORT_ASC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'event_date' => $this->event_date,
//            'bet_slip.status' => $this->status,
            'outright.parent_outright_id' => $this->parent_outright_id,
//            'completed' => $this->completed,
//            'match.game_id' => $this->gameId,
//            'match.home_team' => $this->home_team,
//            'match.away_team' => $this->away_team,
        ]);
//
//        $query->groupBy(['match.parent_match_id', 'odd_type.sub_type_id']);
//        die(print_r($query->createCommand()->getRawSql()));
        return $dataProvider;
    }

}
