<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jackpot_bet".
 *
 * @property integer $jackpot_bet_id
 * @property integer $bet_id
 * @property integer $jackpot_event_id
 * @property string $status
 * @property string $created
 * @property string $modified
 *
 * @property Bet $bet
 * @property JackpotEvent $jackpotEvent
 */
class JackpotBet extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'jackpot_bet';
    }

    public static function getDb() {
        return Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['bet_id', 'jackpot_event_id', 'created'], 'required'],
            [['bet_id', 'jackpot_event_id'], 'integer'],
            [['status'], 'string'],
            [['created', 'modified'], 'safe'],
            [['bet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bet::className(), 'targetAttribute' => ['bet_id' => 'bet_id']],
            [['jackpot_event_id'], 'exist', 'skipOnError' => true, 'targetClass' => JackpotEvent::className(), 'targetAttribute' => ['jackpot_event_id' => 'jackpot_event_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'jackpot_bet_id' => 'Jackpot Bet ID',
            'bet_id' => 'Bet ID',
            'jackpot_event_id' => 'Jackpot Event ID',
            'status' => 'Status',
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
    public function getJackpotEvent() {
        return $this->hasOne(JackpotEvent::className(), ['jackpot_event_id' => 'jackpot_event_id']);
    }

}
