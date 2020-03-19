<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bonus_trx".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $account
 * @property integer $iscredit
 * @property string $reference
 * @property string $amount
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property integer $profile_bonus_id
 */
class BonusTrx extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'bonus_trx';
    }

/*    public static function getDb() {
        return Yii::$app->slavedb;
    }*/

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['profile_id', 'account', 'iscredit', 'reference', 'amount', 'created_by', 'created'], 'required'],
            [['profile_id', 'iscredit', 'profile_bonus_id'], 'integer'],
            [['amount'], 'number'],
            [['created', 'modified'], 'safe'],
            [['account', 'reference'], 'string', 'max' => 50],
            [['created_by'], 'string', 'max' => 60],
            [['profile_id', 'reference', 'iscredit'], 'unique', 'targetAttribute' => ['profile_id', 'reference', 'iscredit'], 'message' => 'The combination of Profile ID, Iscredit and Reference has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'profile_id' => 'Profile ID',
            'account' => 'Account',
            'iscredit' => 'Iscredit',
            'reference' => 'Reference',
            'amount' => 'Amount',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'profile_bonus_id' => 'Profile Bonus ID',
        ];
    }

}
