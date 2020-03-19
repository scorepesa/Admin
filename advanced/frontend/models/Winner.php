<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "winner".
 *
 * @property integer $winner_id
 * @property integer $bet_id
 * @property string $bet_amount
 * @property string $win_amount
 * @property integer $profile_id
 * @property integer $credit_status
 * @property string $created_by
 * @property string $created
 * @property string $modified
 *
 * @property Bet $bet
 * @property Profile $profile
 */
class Winner extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'winner';
    }

    public static function getDb() {
        return Yii::$app->slavedb;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['bet_id', 'bet_amount', 'win_amount', 'profile_id', 'created_by', 'created'], 'required'],
            [['bet_id', 'profile_id', 'credit_status'], 'integer'],
            [['bet_amount', 'win_amount'], 'number'],
            [['created', 'modified'], 'safe'],
            [['created_by'], 'string', 'max' => 70],
            [['bet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bet::className(), 'targetAttribute' => ['bet_id' => 'bet_id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'profile_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'winner_id' => 'Winner ID',
            'bet_id' => 'Bet ID',
            'bet_amount' => 'Bet Amount',
            'win_amount' => 'Win Amount',
            'profile_id' => 'Profile ID',
            'credit_status' => 'Credit Status',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBet() {
        return $this->hasOne(Bet::className(), ['bet_id' => 'bet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile() {
        return $this->hasOne(Profile::className(), ['profile_id' => 'profile_id']);
    }

    /**
     * @inheritdoc
     * @return WinnerQuery the active query used by this AR class.
     */
    public static function find() {
        return new WinnerQuery(get_called_class());
    }

}
