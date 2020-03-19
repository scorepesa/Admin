<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "virtual_match".
 *
 * @property integer $v_match_id
 * @property integer $parent_virtual_id
 * @property string $home_team
 * @property string $away_team
 * @property string $start_time
 * @property integer $competition_id
 * @property integer $status
 * @property integer $instance_id
 * @property string $bet_closure
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property string $result
 * @property string $ht_score
 * @property string $ft_score
 * @property integer $completed
 * @property integer $priority
 *
 * @property VirtualEventOdd[] $virtualEventOdds
 * @property VirtualCompetition $competition
 * @property VirtualOutcome[] $virtualOutcomes
 */
class VirtualMatch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'virtual_match';
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
            [['parent_virtual_id', 'home_team', 'away_team', 'start_time', 'competition_id', 'status', 'bet_closure', 'created_by', 'created'], 'required'],
            [['parent_virtual_id', 'competition_id', 'status', 'instance_id', 'completed', 'priority'], 'integer'],
            [['start_time', 'bet_closure', 'created', 'modified'], 'safe'],
            [['home_team', 'away_team'], 'string', 'max' => 50],
            [['created_by'], 'string', 'max' => 60],
            [['result'], 'string', 'max' => 45],
            [['ht_score', 'ft_score'], 'string', 'max' => 5],
            [['parent_virtual_id'], 'unique'],
            [['competition_id'], 'exist', 'skipOnError' => true, 'targetClass' => VirtualCompetition::className(), 'targetAttribute' => ['competition_id' => 'v_competition_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'v_match_id' => 'V Match ID',
            'parent_virtual_id' => 'Parent Virtual ID',
            'home_team' => 'Home Team',
            'away_team' => 'Away Team',
            'start_time' => 'Start Time',
            'competition_id' => 'Competition ID',
            'status' => 'Status',
            'instance_id' => 'Instance ID',
            'bet_closure' => 'Bet Closure',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'result' => 'Result',
            'ht_score' => 'Ht Score',
            'ft_score' => 'Ft Score',
            'completed' => 'Completed',
            'priority' => 'Priority',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVirtualEventOdds()
    {
        return $this->hasMany(VirtualEventOdd::className(), ['parent_virtual_id' => 'parent_virtual_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetition()
    {
        return $this->hasOne(VirtualCompetition::className(), ['v_competition_id' => 'competition_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVirtualOutcomes()
    {
        return $this->hasMany(VirtualOutcome::className(), ['parent_virtual_id' => 'parent_virtual_id']);
    }
}
