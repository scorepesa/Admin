<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BetSlipMaster;

/**
 * BetSlipSearch represents the model behind the search form about `app\models\BetSlip`.
 */
class BetSlipMasterSearch extends BetSlipMaster {

    public $gameId;
    public $betGameId;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_match_id', 'live_bet', 'bet_id', 'total_games', 'win', 'status', 'sub_type_id'], 'integer'],
            [['odd_value'], 'number'],
            [['created', 'modified', 'live_bet', 'gameId', 'betGameId'], 'safe'],
            [['bet_pick'], 'string', 'max' => 10],
            [['special_bet_value'], 'string', 'max' => 20],
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
        if (!empty($params['BetSlipMasterSearch']['betGameId'])) {
            $query = BetSlip::find();
            $query->join('inner join', 'bet', 'bet.bet_id = bet_slip.bet_id');
            $query->join('inner join', 'match', 'match.parent_match_id = bet_slip.parent_match_id');
//            $query->andWhere(['>=', 'bet_slip.created', new \yii\db\Expression('NOW() - INTERVAL 10 DAY')]);
            // add conditions that should always apply here
            $query->limit(50);

            $dataProvider = new ActiveDataProvider([
                'query' => $query
            ]);

            $this->load($params);
            /* $bet_id = $params['BetSlipSearch']['bet_slipbet_id'];
              $query = $query->createCommand()->getRawSql() */

            if (!$this->validate()) {

                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                'bet_slip_id' => $this->bet_slip_id,
                'parent_match_id' => $this->parent_match_id,
                'match.game_id' => $this->gameId,
                'match.game_id' => $this->betGameId,
                'bet_slip.bet_id' => $this->bet_id,
                'total_games' => $this->total_games,
                'odd_value' => $this->odd_value,
                'win' => $this->win,
                'live_bet'=>$this->live_bet,
                'created' => $this->created,
                'modified' => $this->modified,
                'bet.status' => $this->status,
                'sub_type_id' => $this->sub_type_id,
            ]);

            $query->andFilterWhere(['like', 'bet_pick', $this->bet_pick])
                    ->andFilterWhere(['like', 'match.game_id', $this->betGameId])
                    ->andFilterWhere(['like', 'match.game_id', $this->gameId]);
//        print_r($query->createCommand()->getRawSql());
//        die();
        } else {
            $query = BetSlip::findBySql("select * from bet_slip limit 50");
//            $query->where(['>', 'created', new \yii\db\Expression('NOW() - INTERVAL 1 SECOND')]);

             /*print_r($query->createCommand()->getRawSql());
              die();*/ 
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => -1,
                ],
            ]);
        }
        return $dataProvider;
    }

}
