<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "virtual_odd_type".
 *
 * @property integer $v_bet_type_id
 * @property string $name
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property integer $sub_type_id
 * @property integer $live_bet
 * @property string $short_name
 * @property string $priority
 *
 * @property VirtualEventOdd[] $virtualEventOdds
 */
class VirtualOddType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'virtual_odd_type';
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
            [['name', 'created_by', 'created', 'sub_type_id', 'short_name'], 'required'],
            [['created', 'modified'], 'safe'],
            [['sub_type_id', 'live_bet'], 'integer'],
            [['priority'], 'number'],
            [['name', 'created_by'], 'string', 'max' => 70],
            [['short_name'], 'string', 'max' => 10],
            [['sub_type_id', 'live_bet'], 'unique', 'targetAttribute' => ['sub_type_id', 'live_bet'], 'message' => 'The combination of Sub Type ID and Live Bet has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'v_bet_type_id' => 'V Bet Type ID',
            'name' => 'Name',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'sub_type_id' => 'Sub Type ID',
            'live_bet' => 'Live Bet',
            'short_name' => 'Short Name',
            'priority' => 'Priority',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVirtualEventOdds()
    {
        return $this->hasMany(VirtualEventOdd::className(), ['sub_type_id' => 'sub_type_id']);
    }
}
