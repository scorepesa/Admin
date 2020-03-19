<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "odd_type".
 *
 * @property int $bet_type_id
 * @property string $name
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property int $sub_type_id
 * @property int $live_bet
 * @property string $short_name
 * @property int $priority
 *
 * @property OddKeyAlias[] $oddKeyAliases
 */
class OddType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'odd_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_by', 'created', 'sub_type_id', 'short_name'], 'required'],
            [['created', 'modified'], 'safe'],
            [['sub_type_id', 'live_bet', 'priority'], 'integer'],
            [['name', 'created_by'], 'string', 'max' => 70],
            [['short_name'], 'string', 'max' => 10],
            [['sub_type_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bet_type_id' => 'Bet Type ID',
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
    public function getOddKeyAliases()
    {
        return $this->hasMany(OddKeyAlias::className(), ['sub_type_id' => 'sub_type_id']);
    }
}
