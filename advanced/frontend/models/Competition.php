<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "competition".
 *
 * @property int $competition_id
 * @property string $competition_name
 * @property int $betradar_competition_id
 * @property string $category
 * @property int $category_id
 * @property int $status
 * @property int $sport_id
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property int $priority
 * @property int $ussd_priority
 * @property string $max_stake
 * @property string $alias
 *
 * @property Sport $sport
 */
class Competition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'competition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['competition_name', 'betradar_competition_id', 'category', 'status', 'sport_id', 'created_by', 'created'], 'required'],
            [['betradar_competition_id', 'category_id', 'status', 'sport_id', 'priority', 'ussd_priority'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['max_stake'], 'number'],
            [['competition_name', 'category'], 'string', 'max' => 120],
            [['created_by'], 'string', 'max' => 70],
            [['alias'], 'string', 'max' => 20],
            [['competition_name', 'category', 'sport_id'], 'unique', 'targetAttribute' => ['competition_name', 'category', 'sport_id']],
            [['sport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sport::className(), 'targetAttribute' => ['sport_id' => 'sport_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'competition_id' => 'Competition ID',
            'competition_name' => 'Competition Name',
            'betradar_competition_id' => 'Betradar Competition ID',
            'category' => 'Category',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'sport_id' => 'Sport ID',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'priority' => 'Priority',
            'ussd_priority' => 'Ussd Priority',
            'max_stake' => 'Max Stake',
            'alias' => 'Alias',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSport()
    {
        return $this->hasOne(Sport::className(), ['sport_id' => 'sport_id']);
    }
}
