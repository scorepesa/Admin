<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "incoming_match".
 *
 * @property integer $incoming_match_id
 * @property string $parent_match_id
 * @property string $sport_name
 * @property string $competition_name
 * @property string $competition_category
 * @property string $start_time
 * @property string $end_time
 * @property string $home_team
 * @property string $away_team
 * @property double $home_odd
 * @property double $neutral_odd
 * @property double $away_odd
 * @property integer $active
 * @property string $created
 *
 * @property IncomingOdd[] $incomingOdds
 */
class IncomingMatch extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'incoming_match';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_match_id', 'sport_name', 'competition_name', 'competition_category', 'start_time', 'end_time', 'home_team', 'away_team', 'home_odd', 'neutral_odd', 'away_odd'], 'required'],
            [['start_time', 'end_time', 'created'], 'safe'],
            [['home_odd', 'neutral_odd', 'away_odd'], 'number'],
            [['active'], 'integer'],
            [['parent_match_id', 'sport_name'], 'string', 'max' => 20],
            [['competition_name', 'competition_category', 'home_team', 'away_team'], 'string', 'max' => 50],
            [['parent_match_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'incoming_match_id' => 'Incoming Match ID',
            'parent_match_id' => 'Parent Match ID',
            'sport_name' => 'Sport Name',
            'competition_name' => 'Competition Name',
            'competition_category' => 'Competition Category',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'home_team' => 'Home Team',
            'away_team' => 'Away Team',
            'home_odd' => 'Home Odd',
            'neutral_odd' => 'Neutral Odd',
            'away_odd' => 'Away Odd',
            'active' => 'Active',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncomingOdds() {
        return $this->hasMany(IncomingOdd::className(), ['parent_match_id' => 'parent_match_id']);
    }

    /**
     * @inheritdoc
     * @return IncomingMatchQuery the active query used by this AR class.
     */
    public static function find() {
        return new IncomingMatchQuery(get_called_class());
    }

    public static function getDb() {
        return Yii::$app->db2;
    }

}
