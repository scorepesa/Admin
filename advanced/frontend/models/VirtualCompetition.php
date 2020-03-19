<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "virtual_competition".
 *
 * @property integer $v_competition_id
 * @property string $competition_name
 * @property string $category
 * @property integer $status
 * @property integer $category_id
 * @property integer $sport_id
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property integer $priority
 * @property string $max_stake
 *
 * @property VirtualMatch[] $virtualMatches
 */
class VirtualCompetition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'virtual_competition';
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
            [['competition_name', 'category', 'status', 'sport_id', 'created_by', 'created'], 'required'],
            [['status', 'category_id', 'sport_id', 'priority'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['max_stake'], 'number'],
            [['competition_name', 'category'], 'string', 'max' => 120],
            [['created_by'], 'string', 'max' => 70],
            [['competition_name', 'category', 'sport_id'], 'unique', 'targetAttribute' => ['competition_name', 'category', 'sport_id'], 'message' => 'The combination of Competition Name, Category and Sport ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'v_competition_id' => 'V Competition ID',
            'competition_name' => 'Competition Name',
            'category' => 'Category',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'sport_id' => 'Sport ID',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'priority' => 'Priority',
            'max_stake' => 'Max Stake',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVirtualMatches()
    {
        return $this->hasMany(VirtualMatch::className(), ['competition_id' => 'v_competition_id']);
    }
}
