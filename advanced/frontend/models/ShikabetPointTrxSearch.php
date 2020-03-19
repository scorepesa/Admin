<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ScorepesaPointTrx;

/**
 * ScorepesaPointTrxSearch represents the model behind the search form of `app\models\ScorepesaPointTrx`.
 */
class ScorepesaPointTrxSearch extends ScorepesaPointTrx {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['scorepesa_point_trx_id', 'trx_id', 'profileId'], 'integer'],
            [['points'], 'number'],
            [['trx_type', 'status', 'created', 'modified'], 'safe'],
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
        $query = ScorepesaPointTrx::find();

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
            'scorepesa_point_trx_id' => $this->scorepesa_point_trx_id,
            'trx_id' => $this->trx_id,
            'points' => $this->points,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'trx_type', $this->trx_type])
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public function searchJoin($params) {
        $query = ScorepesaPointTrx::find();
        $query->join('inner join', 'transaction', 'transaction.id = scorepesa_point_trx.trx_id');
        $query->join('inner join', 'profile', 'profile.profile_id = transaction.profile_id');

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
            'scorepesa_point_trx_id' => $this->scorepesa_point_trx_id,
            'trx_id' => $this->trx_id,
            'profile.profile_id' => $this->profileId,
            'points' => $this->points,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'trx_type', $this->trx_type])
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

}
