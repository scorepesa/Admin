<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_balance".
 *
 * @property integer $profile_balance_id
 * @property integer $profile_id
 * @property string $balance
 * @property integer $transaction_id
 * @property string $created
 * @property string $modified
 *
 * @property Profile $profile
 */
class ProfileBalance extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'profile_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['profile_id', 'balance', 'transaction_id', 'created'], 'required'],
            [['profile_id', 'transaction_id'], 'integer'],
            [['balance', 'bonus_balance'], 'number'],
            [['created', 'modified', 'bonus_balance'], 'safe'],
            [['profile_id'], 'unique'],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'profile_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'profile_balance_id' => 'Profile Balance ID',
            'profile_id' => 'Profile ID',
            'balance' => 'Balance',
            'transaction_id' => 'Transaction ID',
            'created' => 'Created',
            'modified' => 'Modified',
            'bonus_balance' => 'Bonus Balance'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile() {
        return $this->hasOne(Profile::className(), ['profile_id' => 'profile_id']);
    }

}
