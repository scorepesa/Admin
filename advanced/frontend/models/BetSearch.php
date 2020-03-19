<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bet;

/**
 * InboxSearch represents the model behind the search form about `app\models\Inbox`.
 */
class BetSearch extends Bet {

    public $profileName;
    public $totalGames;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['total_odd', 'bet_amount', 'possible_win', 'status', 'win', 'bet_id'], 'number'],
            [['created', 'modified', 'profileName', 'totalGames'], 'safe'],
            [['bet_message'], 'string', 'max' => 200],
            [['reference', 'created_by'], 'string', 'max' => 70],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'profile_id']],
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
       if (!empty($params['BetSearch']['bet_amount']) || !empty($params['BetSearch']['profileName']) || !empty($params['BetSearch']['bet_id']) || !empty($params['BetSearch']['possible_win']) || !empty($params['BetSearch']['status'])) {
          //        $subQuery = (new \yii\db\Query())->select('MAX(bet_id)-20000000 as mId')->from('bet')->all();
          //        $minID = $subQuery[0]['mId'];

          $query = Bet::find()->select('bet.bet_id,profile.profile_id,bet.created,bet.total_odd,bet.bet_amount,bet.possible_win,bet.status,bet.win,bet.reference');
          $query->join('inner join', 'profile', 'profile.profile_id = bet.profile_id');
          // add conditions that should always apply here

          $dataProvider = new ActiveDataProvider([
              'query' => $query,
              'sort' => [
                  'defaultOrder' => [
                      'bet_id' => SORT_DESC,
                    //'modified' => SORT_ASC, 
                  ]
              ],
          ]);

          $this->load($params);

          if (!$this->validate()) {
              // uncomment the following line if you do not want to return any records when validation fails
              // $query->where('0=1');
              return $dataProvider;
          }
          //        $query->andFilterWhere(['>', 'bet.bet_id', $minID]);
          // grid filtering conditions
          $query->andFilterWhere([
              'bet_id' => $this->bet_id,
              'bet.status' => $this->status,
              'bet.win' => $this->win,
//            'reference' => $this->reference,
              'bet.profile_id' => $this->profile_id,
//            'bet.created' => $this->created,
//            'bet_slip.total_games' => $this->totalGames
          ]);

          $query->andFilterWhere(['like', 'bet_message', $this->bet_message])
                ->andFilterWhere(['like', 'profile.msisdn', $this->profileName])
                ->andFilterWhere(['>=', 'bet.bet_amount', $this->bet_amount])
                ->andFilterWhere(['>=', 'bet.total_odd', $this->total_odd])
                ->andFilterWhere(['>=', 'bet.possible_win', $this->possible_win])
                ->andFilterWhere(['>=', 'bet_slip.total_games', $this->totalGames])
                ->andFilterWhere(['like', 'reference', $this->reference])
                ->andFilterWhere(['like', 'bet.created_by', $this->created_by])
               ->limit(50);

          } else {
              //$query = BetSlip::findBySql("select * from bet_slip limit 1");

              $query = Bet::findBySql('select bet.bet_id,profile.profile_id,bet.created,bet.total_odd,bet.bet_amount,bet.possible_win,bet.status,bet.win,bet.reference from bet inner join profile on profile.profile_id = bet.profile_id order by created desc limit 50');


              /* print_r($query->createCommand()->getRawSql());
                die(); */
              $dataProvider = new ActiveDataProvider([
                   'query' => $query,
                   'pagination' => [
                       'pageSize' => -1,
                   ],
              ]);

          }

       return $dataProvider; 
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function unsettled($params) {
       if (!empty($params['BetSearch']['bet_amount']) || !empty($params['BetSearch']['profileName']) || !empty($params['BetSearch']['bet_id']) || !empty($params['BetSearch']['possible_win']) || !empty($params['BetSearch']['status'])) {
          //        $subQuery = (new \yii\db\Query())->select('MAX(bet_id)-20000000 as mId')->from('bet')->all();
          //        $minID = $subQuery[0]['mId'];

          $query = Bet::find()->select('bet.bet_id,profile.profile_id,bet.created,bet.total_odd,bet.bet_amount,bet.possible_win,bet.status,bet.win,bet.reference');
          $query->join('inner join', 'profile', 'profile.profile_id = bet.profile_id');
          // add conditions that should always apply here

          $dataProvider = new ActiveDataProvider([
              'query' => $query,
              'sort' => [
                  'defaultOrder' => [
                      'bet_id' => SORT_DESC,
                    //'modified' => SORT_ASC, 
                  ]
              ],
          ]);
          $query->where(['bet.status' => [1,400]]);
          $query->andWhere(['<', 'bet.created', new \yii\db\Expression('now()-interval 2 hour') ]);
          $this->load($params);

          if (!$this->validate()) {
              // uncomment the following line if you do not want to return any records when validation fails
              // $query->where('0=1');
              return $dataProvider;
          }
          //        $query->andFilterWhere(['>', 'bet.bet_id', $minID]);
          // grid filtering conditions
          $query->andFilterWhere([
              'bet_id' => $this->bet_id,
        //      'bet.status' => $this->status,
              'bet.win' => $this->win,
//            'reference' => $this->reference,
              'bet.profile_id' => $this->profile_id,
//            'bet.created' => $this->created,
//            'bet_slip.total_games' => $this->totalGames
          ]);

          $query->andFilterWhere(['like', 'bet_message', $this->bet_message])
                ->andFilterWhere(['like', 'profile.msisdn', $this->profileName])
                ->andFilterWhere(['>=', 'bet.bet_amount', $this->bet_amount])
                ->andFilterWhere(['>=', 'bet.total_odd', $this->total_odd])
                ->andFilterWhere(['>=', 'bet.possible_win', $this->possible_win])
                ->andFilterWhere(['>=', 'bet_slip.total_games', $this->totalGames])
                ->andFilterWhere(['like', 'reference', $this->reference])
                ->andFilterWhere(['like', 'bet.created_by', $this->created_by])
               ->limit(50);

          } else {
              //$query = BetSlip::findBySql("select * from bet_slip limit 1");

              $query = Bet::findBySql('select distinct bet.bet_id,profile.profile_id,bet.created,bet.total_odd,bet.bet_amount,bet.possible_win,bet.status,bet.win,bet.reference from bet inner join profile on profile.profile_id = bet.profile_id  inner join bet_slip s on s.bet_id = bet.bet_id inner join `match` m on m.parent_match_id = s.parent_match_id where bet.status in (1, 400) and m.start_time < now()-interval 2 hour order by bet.created desc limit 100 ');


              /* print_r($query->createCommand()->getRawSql());
                die(); */
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
