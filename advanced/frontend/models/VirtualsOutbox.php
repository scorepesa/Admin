<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outbox".
 *
 * @property integer $outbox_id
 * @property string $shortcode
 * @property string $network
 * @property integer $profile_id
 * @property string $linkid
 * @property string $date_created
 * @property string $date_sent
 * @property integer $retry_status
 * @property string $modified
 * @property string $text
 * @property string $msisdn
 * @property string $sdp_id
 *
 * @property ProfileMap $profile
 */
class VirtualsOutbox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outbox';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('virtualsdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'retry_status'], 'integer'],
            [['date_created', 'date_sent', 'modified'], 'safe'],
            [['text'], 'string'],
            [['shortcode'], 'string', 'max' => 30],
            [['network'], 'string', 'max' => 50],
            [['linkid', 'sdp_id'], 'string', 'max' => 100],
            [['msisdn'], 'string', 'max' => 25],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProfileMap::className(), 'targetAttribute' => ['profile_id' => 'scorepesa_profile_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
            'sdp_id' => 'Sdp ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(ProfileMap::className(), ['scorepesa_profile_id' => 'profile_id']);
    }
}
