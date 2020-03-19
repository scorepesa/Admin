<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Outbox;

/**
 * OutboxSearch represents the model behind the search form about `app\models\Outbox`.
 */
class OutboxSearch extends Outbox {

    public $maxColumn = 0;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['outbox_id', 'shortcode', 'profile_id', 'retry_status'], 'integer'],
            [['network', 'linkid', 'date_created', 'date_sent', 'modified', 'text', 'msisdn'], 'safe'],
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
        if (!empty($params['OutboxSearch']['msisdn']) || !empty($params['OutboxSearch']['text']) || !empty($params['OutboxSearch']['shortcode']) || !empty($params['OutboxSearch']['profile_id'])) {
              #$maxId = $this->getMax($filter);
              $max = Outbox::find()->select('max(outbox_id)')->scalar();

              #$query = Outbox::find();
              if (!empty($params['OutboxSearch']['msisdn'])) {
                  $query = Outbox::findBySql("select date_created, msisdn, shortcode,text from outbox where outbox_id > $max-1000000 and msisdn like '%". $params['OutboxSearch']['msisdn'] ."%' order by outbox_id desc limit 500");
              }else{
                  $query = Outbox::findBySql("select date_created, msisdn, shortcode,text from outbox where outbox_id > $max-1000000 and `text` like '%". $params['OutboxSearch']['text'] ."%' order by outbox_id desc limit 500");
              }
              #$subQuery = (new \yii\db\Query())->select('MAX(outbox_id)-2500000 as mId')->from('outbox')->one();
              #$minID = $subQuery['mId'];
           // add conditions that should always apply here
              #$query->andFilterWhere(['>', 'outbox_id', $max-1000000]);
              #$query = Outbox::findBySql("select * from outbox where outbox_id > $maxId - 2000000");
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
                //'outbox_id' => $this->outbox_id,
                'shortcode' => $this->shortcode,
                'profile_id' => $this->profile_id,
                //'date_created' => $this->date_created,
                'date_sent' => $this->date_sent,
                //'retry_status' => $this->retry_status,
                'modified' => $this->modified
              ]);

              $query->andFilterWhere(['like', 'text', $this->text])
                  ->andFilterWhere(['like', 'msisdn', $this->msisdn]);

              /*print_r($query->createCommand()->getRawSql());
                   die();*/

        } else {
              //$query = BetSlip::findBySql("select * from bet_slip limit 1");

              $query = Outbox::findBySql('select date_created, msisdn, shortcode,text from outbox limit 0');

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

    public function getMax($filter = null) {
       /* Get max in column1 WHERE column2 = $filter */
       $criteria = new CDbCriteria;
       $criteria->select = 'MAX(outbox_id) as maxColumn';
       #$criteria->condition = 't.column2 LIKE :parm';
       #$criteria->params = array(':parm'=>$filter);

       $tempmodel = $this->find($criteria);
       $max = $tempmodel['maxColumn'];
       return $max;
    }

}
