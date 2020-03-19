<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "odds_change".
 *
 * @property integer $odds_change_id
 * @property string $parent_match_id
 * @property string $subtype
 * @property string $key
 * @property string $value
 * @property string $match_time
 * @property string $score
 * @property string $bet_status
 * @property string $created
 */
class OddsChange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'odds_change';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_match_id', 'subtype', 'key', 'value', 'match_time', 'score', 'bet_status'], 'required'],
            [['parent_match_id', 'subtype', 'key', 'value', 'match_time', 'score', 'bet_status'], 'string'],
            [['created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'odds_change_id' => Yii::t('app', 'Odds Change ID'),
            'parent_match_id' => Yii::t('app', 'Parent Match ID'),
            'subtype' => Yii::t('app', 'Subtype'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'match_time' => Yii::t('app', 'Match Time'),
            'score' => Yii::t('app', 'Score'),
            'bet_status' => Yii::t('app', 'Bet Status'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @inheritdoc
     * @return OddsChangeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OddsChangeQuery(get_called_class());
    }
}
