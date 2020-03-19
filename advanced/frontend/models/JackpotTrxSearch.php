<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JackpotTrx;

/**
 * JackpotTrxSearch represents the model behind the search form about `app\models\JackpotTrx`.
 */
class JackpotTrxSearch extends JackpotTrx
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jackpot_trx_id', 'trx_id', 'jackpot_event_id'], 'integer'],
            [['created', 'modified'], 'safe'],
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
        $query = JackpotTrx::find();

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
            'jackpot_trx_id' => $this->jackpot_trx_id,
            'trx_id' => $this->trx_id,
            'jackpot_event_id' => $this->jackpot_event_id,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        return $dataProvider;
    }
}
