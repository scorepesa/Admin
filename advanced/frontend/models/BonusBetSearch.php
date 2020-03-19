<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BonusBet;

/**
 * BonusBetSearch represents the model behind the search form about `app\models\BonusBet`.
 */
class BonusBetSearch extends BonusBet {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['bonus_bet_id', 'bet_id', 'profile_bonus_id', 'won'], 'integer'],
            [['bet_amount', 'possible_win', 'ratio'], 'number'],
            [['created_by', 'created', 'modified', 'status'], 'safe'],
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
        $query = BonusBet::find();

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
            'bonus_bet_id' => $this->bonus_bet_id,
            'bet_id' => $this->bet_id,
            'bet_amount' => $this->bet_amount,
            'possible_win' => $this->possible_win,
            'profile_bonus_id' => $this->profile_bonus_id,
            'won' => $this->won,
            'status' => $this->status,
            'ratio' => $this->ratio,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }

}
