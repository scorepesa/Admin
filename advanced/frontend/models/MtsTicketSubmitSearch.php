<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MtsTicketSubmit;

/**
 * MtsTicketSubmitSearch represents the model behind the search form of `app\models\MtsTicketSubmit`.
 */
class MtsTicketSubmitSearch extends MtsTicketSubmit {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['mts_ticket_submit_id', 'bet_id', 'status'], 'integer'],
            [['mts_ticket', 'response', 'message', 'created', 'modified'], 'safe'],
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
        $query = MtsTicketSubmit::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'mts_ticket_submit_id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'mts_ticket_submit_id' => $this->mts_ticket_submit_id,
            'bet_id' => $this->bet_id,
            'status' => $this->status,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'mts_ticket', $this->mts_ticket])
                ->andFilterWhere(['like', 'response', $this->response])
                ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }

}
