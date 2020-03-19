<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mts_exception".
 *
 * @property integer $mts_exception_id
 * @property string $name
 * @property string $created
 * @property string $modified
 */
class MtsException extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mts_exception';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created'], 'required'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mts_exception_id' => 'Mts Exception ID',
            'name' => 'Name',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
