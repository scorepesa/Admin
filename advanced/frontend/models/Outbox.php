<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outbox".
 *
 * @property integer $outbox_id
 * @property integer $shortcode
 * @property string $network
 * @property integer $profile_id
 * @property string $linkid
 * @property string $date_created
 * @property string $date_sent
 * @property integer $retry_status
 * @property string $modified
 * @property string $text
 * @property string $msisdn
 *
 * @property Profile $profile
 */
class Outbox extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'outbox';
    }


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['shortcode', 'profile_id', 'retry_status'], 'integer'],
            [['date_created', 'date_sent', 'modified'], 'safe'],
            [['text'], 'string'],
            [['network'], 'string', 'max' => 50],
            [['linkid'], 'string', 'max' => 100],
            [['msisdn'], 'string', 'max' => 25],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'profile_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'outbox_id' => 'Outbox ID',
            'shortcode' => 'Shortcode',
            'network' => 'Network',
            'profile_id' => 'Profile ID',
            'linkid' => 'Linkid',
            'date_created' => 'Date Created',
            'date_sent' => 'Date Sent',
            'retry_status' => 'Retry Status',
            'modified' => 'Modified',
            'text' => 'Text',
            'msisdn' => 'Msisdn',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile() {
        return $this->hasOne(Profile::className(), ['profile_id' => 'profile_id']);
    }

    /**
     * @inheritdoc
     * @return OutboxQuery the active query used by this AR class.
     */
    public static function find() {
        return new OutboxQuery(get_called_class());
    }

}
