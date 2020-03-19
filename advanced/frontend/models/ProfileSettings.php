<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_settings".
 *
 * @property integer $profile_setting_id
 * @property integer $profile_id
 * @property integer $balance
 * @property integer $status
 * @property integer $verification_code
 * @property string $name
 * @property string $reference_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $password
 * @property string $max_stake
 */
class ProfileSettings extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'profile_settings';
    }

 /*   public static function getDb() {
        return Yii::$app->slavedb;
    }*/

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['profile_id', 'balance', 'status', 'verification_code'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['password'], 'required'],
            [['password'], 'string'],
            [['max_stake'], 'number'],
            [['name'], 'string', 'max' => 250],
            [['reference_id'], 'string', 'max' => 20],
            [['profile_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'profile_setting_id' => 'Profile Setting ID',
            'profile_id' => 'Profile ID',
            'balance' => 'Balance',
            'status' => 'Status',
            'verification_code' => 'Verification Code',
            'name' => 'Name',
            'reference_id' => 'Reference ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password' => 'Password',
            'max_stake' => 'Max Stake',
        ];
    }

}
