<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "virtual_event_odd".
 *
 * @property integer $v_event_odd_id
 * @property integer $parent_virtual_id
 * @property integer $sub_type_id
 * @property string $max_bet
 * @property string $created
 * @property string $modified
 * @property string $odd_key
 * @property string $odd_value
 * @property string $odd_alias
 * @property string $special_bet_value
 *
 * @property VirtualMatch $parentVirtual
 * @property VirtualOddType $subType
 */
class VirtualEventOdd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'virtual_event_odd';
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
            [['parent_virtual_id', 'max_bet', 'created', 'odd_key'], 'required'],
            [['parent_virtual_id', 'sub_type_id'], 'integer'],
            [['max_bet'], 'number'],
            [['created', 'modified'], 'safe'],
            [['odd_key', 'odd_value', 'odd_alias', 'special_bet_value'], 'string', 'max' => 20],
            [['parent_virtual_id', 'sub_type_id', 'odd_key', 'special_bet_value'], 'unique', 'targetAttribute' => ['parent_virtual_id', 'sub_type_id', 'odd_key', 'special_bet_value'], 'message' => 'The combination of Parent Virtual ID, Sub Type ID, Odd Key and Special Bet Value has already been taken.'],
            [['parent_virtual_id'], 'exist', 'skipOnError' => true, 'targetClass' => VirtualMatch::className(), 'targetAttribute' => ['parent_virtual_id' => 'parent_virtual_id']],
            [['sub_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => VirtualOddType::className(), 'targetAttribute' => ['sub_type_id' => 'sub_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'v_event_odd_id' => 'V Event Odd ID',
            'parent_virtual_id' => 'Parent Virtual ID',
            'sub_type_id' => 'Sub Type ID',
            'max_bet' => 'Max Bet',
            'created' => 'Created',
            'modified' => 'Modified',
            'odd_key' => 'Odd Key',
            'odd_value' => 'Odd Value',
            'odd_alias' => 'Odd Alias',
            'special_bet_value' => 'Special Bet Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentVirtual()
    {
        return $this->hasOne(VirtualMatch::className(), ['parent_virtual_id' => 'parent_virtual_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubType()
    {
        return $this->hasOne(VirtualOddType::className(), ['sub_type_id' => 'sub_type_id']);
    }
}
