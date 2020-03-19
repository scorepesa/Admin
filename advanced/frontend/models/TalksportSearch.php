<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Talksport;

/**
 * TalksportSearch represents the model behind the search form of `app\models\Talksport`.
 */
class TalksportSearch extends Talksport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['talksport_id', 'parent_match_id'], 'integer'],
            [['stream_url', 'created', 'modified'], 'safe'],
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
        $query = Talksport::find();

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
            'talksport_id' => $this->talksport_id,
            'parent_match_id' => $this->parent_match_id,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'stream_url', $this->stream_url]);

        return $dataProvider;
    }
}
