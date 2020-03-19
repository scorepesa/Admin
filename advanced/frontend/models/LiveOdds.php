<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "live_odds".
 *
 * @property integer $live_odds_id
 * @property string $parent_match_id
 * @property double $home_odd
 * @property double $neutral_odd
 * @property double $away_odd
 * @property string $created
 */
class LiveOdds extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'live_odds_change';
    }

    public static function getDb() {
        return Yii::$app->slavedb;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_match_id', 'subtype', 'key', 'value', 'match_time'], 'required'],
            [['subtype'], 'number'],
            [['created', 'bet_status', 'score'], 'safe'],
            [['parent_match_id'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'live_odds_change_id' => 'Live Odds ID',
            'parent_match_id' => 'Parent Match ID',
            'subtype' => 'Sub Type Id',
            'key' => 'Key',
            'value' => 'Value',
            'match_time' => 'Match Time',
            'score' => 'Score',
            'bet_status' => 'Bet Status',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch() {
        return $this->hasOne(Match::className(), ['parent_match_id' => 'parent_match_id']);
    }

    /**
     * @inheritdoc
     * @return LiveOddsQuery the active query used by this AR class.
     */
    public static function find() {
        return new LiveOddsQuery(get_called_class());
    }

}
