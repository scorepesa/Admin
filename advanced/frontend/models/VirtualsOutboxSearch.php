<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VirtualsOutbox;

/**
 * VirtualsOutboxSearch represents the model behind the search form of `app\models\VirtualsOutbox`.
 */
class VirtualsOutboxSearch extends VirtualsOutbox
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['outbox_id', 'profile_id', 'retry_status'], 'integer'],
            [['shortcode', 'network', 'linkid', 'date_created', 'date_sent', 'modified', 'text', 'msisdn', 'sdp_id'], 'safe'],
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
        $query = VirtualsOutbox::find();

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
            'outbox_id' => $this->outbox_id,
            'profile_id' => $this->profile_id,
            'date_created' => $this->date_created,
            'date_sent' => $this->date_sent,
            'retry_status' => $this->retry_status,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'shortcode', $this->shortcode])
            ->andFilterWhere(['like', 'network', $this->network])
            ->andFilterWhere(['like', 'linkid', $this->linkid])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'msisdn', $this->msisdn])
            ->andFilterWhere(['like', 'sdp_id', $this->sdp_id]);

        return $dataProvider;
    }
}
