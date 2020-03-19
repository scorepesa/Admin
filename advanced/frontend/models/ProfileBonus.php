<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_bonus".
 *
 * @property integer $profile_bonus_id
 * @property integer $profile_id
 * @property string $referred_msisdn
 * @property string $bonus_amount
 * @property string $status
 * @property string $expiry_date
 * @property string $date_created
 * @property string $updated
 *
 * @property BonusBet[] $bonusBets
 * @property BonusBetCount[] $bonusBetCounts
 * @property Profile[] $profiles
 * @property Profile $profile
 */
class ProfileBonus extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'profile_bonus';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['profile_id', 'referred_msisdn', 'expiry_date', 'date_created'], 'required'],
            [['profile_id'], 'integer'],
            [['bonus_amount'], 'number'],
            [['status'], 'string'],
            [['expiry_date', 'date_created', 'updated', 'bet_on_status', 'created_by'], 'safe'],
            [['referred_msisdn'], 'string', 'max' => 25],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'profile_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'profile_bonus_id' => 'Profile Bonus ID',
            'profile_id' => 'Profile ID',
            'referred_msisdn' => 'Referred Msisdn',
            'bonus_amount' => 'Bonus Amount',
            'status' => 'Status',
            'expiry_date' => 'Expiry Date',
            'date_created' => 'Date Created',
            'updated' => 'Updated',
            'bet_on_status' => 'Bet on status',
            'created_by' => 'Created by'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBonusBets() {
        return $this->hasMany(BonusBet::className(), ['profile_bonus_id' => 'profile_bonus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBonusBetCounts() {
        return $this->hasMany(BonusBetCount::className(), ['profile_bonus_id' => 'profile_bonus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles() {
        return $this->hasMany(Profile::className(), ['profile_id' => 'profile_id'])->viaTable('bonus_bet_count', ['profile_bonus_id' => 'profile_bonus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile() {
        return $this->hasOne(Profile::className(), ['profile_id' => 'profile_id']);
    }

}
