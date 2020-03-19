<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "talksport".
 *
 * @property int $talksport_id
 * @property int $parent_match_id
 * @property string $stream_url
 * @property string $created
 * @property string $modified
 */
class Talksport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'talksport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_match_id', 'stream_url', 'created'], 'required'],
            [['parent_match_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['stream_url'], 'string', 'max' => 160],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'talksport_id' => 'Talksport ID',
            'parent_match_id' => 'Parent Match ID',
            'stream_url' => 'Stream Url',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
