<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jackpot_trx".
 *
 * @property integer $jackpot_trx_id
 * @property integer $trx_id
 * @property integer $jackpot_event_id
 * @property string $created
 * @property string $modified
 *
 * @property JackpotEvent $jackpotEvent
 * @property Transaction $trx
 */
class JackpotTrx extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'jackpot_trx';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['trx_id', 'jackpot_event_id', 'created'], 'required'],
            [['trx_id', 'jackpot_event_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['jackpot_event_id'], 'exist', 'skipOnError' => true, 'targetClass' => JackpotEvent::className(), 'targetAttribute' => ['jackpot_event_id' => 'jackpot_event_id']],
            [['trx_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['trx_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'jackpot_trx_id' => 'Jackpot Trx ID',
            'trx_id' => 'Trx ID',
            'jackpot_event_id' => 'Jackpot Event ID',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJackpotEvent() {
        return $this->hasOne(JackpotEvent::className(), ['jackpot_event_id' => 'jackpot_event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrx() {
        return $this->hasOne(Transaction::className(), ['id' => 'trx_id']);
    }

}
