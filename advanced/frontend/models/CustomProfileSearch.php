<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * CustomProfileSearch represents the model behind the search form about `app\models\Profile`.
 */
class CustomProfileSearch extends Profile {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['profile_id', 'status'], 'integer'],
            [['msisdn', 'created', 'modified', 'created_by', 'network'], 'safe'],
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
//        print_r($this->msisdn);
//        die();
        $msisdn = $_GET['CustomProfileSearch']['msisdn'];

        $filter = "";
        if (!empty($msisdn)):
            $filter = " WHERE p.msisdn LIKE '%$msisdn%' ";
        endif;
        $sql = "SELECT p.msisdn,"
                . "(SELECT balance FROM profile_balance WHERE profile_id=p.profile_id)balance,"
                . "(SELECT created FROM transaction "
                . "WHERE profile_id=p.profile_id AND iscredit=1 "
                . "ORDER BY created DESC LIMIT 1)lasttopup,"
                . "(SELECT created FROM transaction "
                . "WHERE profile_id=p.profile_id AND iscredit=1 "
                . "ORDER BY created DESC LIMIT 1)lastWithdraw,"
                . "(SELECT COUNT(bet_id) FROM bet b JOIN bet_slip s USING(bet_id) "
                . "WHERE s.total_games > 1 AND profile_id=p.profile_id)multibets,"
                . "(SELECT COUNT(bet_id) FROM bet b JOIN bet_slip s USING(bet_id) "
                . "WHERE s.total_games = 1 AND profile_id=p.profile_id)singlebets,"
                . "(CASE WHEN EXISTS (SELECT profile_setting_id FROM profile_settings "
                . "WHERE profile_id=p.profile_id) THEN 'WEB' ELSE 'SMS' END)source,(p.created)joined "
                . "FROM profile AS p $filter";

        $count = Yii::$app->db->createCommand($sql)->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => $sql,
            'params' => '',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['msisdn', 'balance', 'lasttopup', 'lastWithdraw',
                    'multibets', 'singlebets', 'source', 'joined'],
            ],
        ]);

// returns an array of data rows
        $models = $provider->getModels();
//        print_r($models);
//        die();
        return $provider;
    }

}
