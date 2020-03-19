<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inbox".
 *
 * @property integer $inbox_id
 * @property string $network
 * @property integer $shortcode
 * @property string $msisdn
 * @property string $message
 * @property string $linkid
 * @property string $created
 * @property string $modified
 * @property string $created_by
 */
class Inbox extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'inbox';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['shortcode'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['network'], 'string', 'max' => 50],
            [['msisdn'], 'string', 'max' => 20],
            [['message'], 'string', 'max' => 300],
            [['linkid'], 'string', 'max' => 100],
            [['created_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'inbox_id' => 'Inbox ID',
            'network' => 'Network',
            'shortcode' => 'Shortcode',
            'msisdn' => 'Msisdn',
            'message' => 'Message',
            'linkid' => 'Linkid',
            'created' => 'Created',
            'modified' => 'Modified',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @inheritdoc
     * @return InboxQuery the active query used by this AR class.
     */
    public static function find() {
        return new InboxQuery(get_called_class());
    }

}
