<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "virtual_sport".
 *
 * @property integer $v_sport_id
 * @property string $sport_name
 * @property string $created_by
 * @property string $created
 * @property string $modified
 */
class VirtualSport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'virtual_sport';
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
            [['sport_name', 'created_by', 'created'], 'required'],
            [['created', 'modified'], 'safe'],
            [['sport_name'], 'string', 'max' => 50],
            [['created_by'], 'string', 'max' => 70],
            [['sport_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'v_sport_id' => 'V Sport ID',
            'sport_name' => 'Sport Name',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
