<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inbox;

/**
 * InboxSearch represents the model behind the search form about `app\models\Inbox`.
 */
class InboxSearch extends Inbox {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['inbox_id', 'shortcode'], 'integer'],
            [['network', 'msisdn', 'message', 'linkid', 'created', 'modified', 'created_by'], 'safe'],
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
        if (!empty($params['InboxSearch']['msisdn']) || !empty($params['InboxSearch']['message']) || !empty($params['InboxSearch']['shortcode']) || !empty($params['InboxSearch']['network'])) {
            $query = Inbox::find();

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
               'inbox_id' => $this->inbox_id,
               'shortcode' => $this->shortcode,
               'created' => $this->created,
               'modified' => $this->modified,
            ]);

            $query->andFilterWhere(['like', 'network', $this->network])
                ->andFilterWhere(['like', 'msisdn', $this->msisdn])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'linkid', $this->linkid])
                ->andFilterWhere(['>=', 'created', new \yii\db\Expression('NOW() - INTERVAL 90 DAY')])
                ->andFilterWhere(['like', 'created_by', $this->created_by]);
            /* echo $query->createCommand()->sql;
            die(); */

        } else {
             $query = Inbox::findBySql('select * from inbox limit 0');

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
