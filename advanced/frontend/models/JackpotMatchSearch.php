<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JackpotMatch;

/**
 * JackpotMatchSearch represents the model behind the search form about `app\models\JackpotMatch`.
 */
class JackpotMatchSearch extends JackpotMatch {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['jackpot_match_id', 'parent_match_id', 'jackpot_event_id'], 'integer'],
            [['status', 'created_by', 'created', 'modified'], 'safe'],
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
        $query = JackpotMatch::find();

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
            'jackpot_match_id' => $this->jackpot_match_id,
            'jackpot_event_id' => $this->jackpot_event_id,
            'parent_match_id' => $this->parent_match_id,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }

}
