<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ScorepesaPoint;

/**
 * ScorepesaPointSearch represents the model behind the search form of `app\models\ScorepesaPoint`.
 */
class ScorepesaPointSearch extends ScorepesaPoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scorepesa_point_id', 'profile_id'], 'integer'],
            [['points', 'redeemed_amount'], 'number'],
            [['created_by', 'status', 'created', 'modified'], 'safe'],
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
        $query = ScorepesaPoint::find();

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
            'scorepesa_point_id' => $this->scorepesa_point_id,
            'profile_id' => $this->profile_id,
            'points' => $this->points,
            'redeemed_amount' => $this->redeemed_amount,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
