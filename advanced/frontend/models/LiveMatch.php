<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "live_match".
 *
 * @property integer $match_id
 * @property integer $parent_match_id
 * @property string $home_team
 * @property string $away_team
 * @property string $start_time
 * @property string $game_id
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
 */
class LiveMatch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'live_match';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_match_id', 'home_team', 'away_team', 'start_time', 'game_id', 'competition_id', 'status', 'bet_closure', 'created_by', 'created'], 'required'],
            [['parent_match_id', 'competition_id', 'status', 'instance_id', 'completed', 'priority'], 'integer'],
            [['start_time', 'bet_closure', 'created', 'modified'], 'safe'],
            [['home_team', 'away_team'], 'string', 'max' => 50],
            [['game_id'], 'string', 'max' => 20],
            [['created_by'], 'string', 'max' => 60],
            [['result'], 'string', 'max' => 45],
            [['ht_score', 'ft_score'], 'string', 'max' => 5],
            [['game_id'], 'unique'],
            [['parent_match_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'match_id' => 'Match ID',
            'parent_match_id' => 'Parent Match ID',
            'home_team' => 'Home Team',
            'away_team' => 'Away Team',
            'start_time' => 'Start Time',
            'game_id' => 'Game ID',
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
    public function getBetSlips() {
        return $this->hasMany(BetSlip::className(), ['parent_match_id' => 'parent_match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetition() {
        return $this->hasOne(Competition::className(), ['competition_id' => 'competition_id']);
    }

    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getCompetitionName() {
        return $this->competition->competition_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventOdd() {
        return $this->hasMany(EventOdd::className(), ['parent_match_id' => 'parent_match_id']);
    }

}
