<?php

namespace app\models;

use yii\data\SqlDataProvider;
use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $profile_id
 * @property string $msisdn
 * @property string $created
 * @property integer $status
 * @property string $modified
 * @property string $created_by
 * @property string $network
 *
 * @property Bet[] $bets
 * @property Outbox[] $outboxes
 * @property Transaction[] $transactions
 * @property Winner[] $winners
 */
class Profile extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'profile';
    }


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['created', 'modified'], 'safe'],
            [['status', 'balance'], 'integer'],
            [['msisdn', 'created_by'], 'string', 'max' => 45],
            [['network'], 'string', 'max' => 50],
            [['msisdn'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'profile_id' => Yii::t('app', 'Profile ID'),
            'msisdn' => Yii::t('app', 'Msisdn'),
            'created' => Yii::t('app', 'Created'),
            'status' => Yii::t('app', 'Status'),
            'modified' => Yii::t('app', 'Modified'),
            'created_by' => Yii::t('app', 'Created By'),
            'network' => Yii::t('app', 'Network'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBets() {
        return $this->hasMany(Bet::className(), ['profile_id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutboxes() {
        return $this->hasMany(Outbox::className(), ['profile_id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions() {
        return $this->hasMany(Transaction::className(), ['profile_id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWinners() {
        return $this->hasMany(Winner::className(), ['profile_id' => 'profile_id']);
    }

    /**
     * 
     * @return type \yii\db\ActiveQuery
     */
    public function getProfileBalance() {
        return $this->hasOne(ProfileBalance::className(), ['profile_id' => 'profile_id']);
    }

    /**
     * 
     * @return type \yii\db\ActiveQuery
     */
    public function getProfileSettings() {
        return $this->hasOne(ProfileSettings::className(), ['profile_id' => 'profile_id']);
    }

    public function userBillingReport() {
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
                . "FROM profile AS p ";

        $csql = "SELECT COUNT(profile_id)total FROM profile";
        $count = Yii::$app->db->createCommand($csql)->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => $sql,
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
