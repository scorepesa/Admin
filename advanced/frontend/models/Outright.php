<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outright".
 *
 * @property integer $outright_id
 * @property integer $parent_outright_id
 * @property string $event_name
 * @property string $event_date
 * @property string $event_end_date
 * @property string $game_id
 * @property integer $competition_id
 * @property integer $status
 * @property integer $instance_id
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property string $result
 * @property integer $completed
 * @property integer $priority
 */
class Outright extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outright';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_outright_id', 'event_name', 'event_date', 'event_end_date', 'competition_id', 'status', 'created_by', 'created'], 'required'],
            [['parent_outright_id', 'competition_id', 'status', 'instance_id', 'completed', 'priority'], 'integer'],
            [['event_date', 'event_end_date', 'created', 'modified'], 'safe'],
            [['event_name'], 'string', 'max' => 100],
            [['game_id'], 'string', 'max' => 20],
            [['created_by'], 'string', 'max' => 60],
            [['result'], 'string', 'max' => 45],
            [['parent_outright_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'outright_id' => 'Outright ID',
            'parent_outright_id' => 'Parent Outright ID',
            'event_name' => 'Event Name',
            'event_date' => 'Event Date',
            'event_end_date' => 'Event End Date',
            'game_id' => 'Game ID',
            'competition_id' => 'Competition ID',
            'status' => 'Status',
            'instance_id' => 'Instance ID',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'result' => 'Result',
            'completed' => 'Completed',
            'priority' => 'Priority',
        ];
    }
}
