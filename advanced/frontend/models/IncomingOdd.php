<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "incoming_odd".
 *
 * @property integer $incoming_odd_id
 * @property string $parent_match_id
 * @property double $home_odd
 * @property double $neutral_odd
 * @property double $away_odd
 * @property string $created
 *
 * @property IncomingMatch $parentMatch
 */
class IncomingOdd extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'incoming_odd';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_match_id', 'home_odd', 'neutral_odd', 'away_odd'], 'required'],
            [['home_odd', 'neutral_odd', 'away_odd'], 'number'],
            [['created'], 'safe'],
            [['parent_match_id'], 'string', 'max' => 20],
            [['parent_match_id'], 'exist', 'skipOnError' => true, 'targetClass' => IncomingMatch::className(), 'targetAttribute' => ['parent_match_id' => 'parent_match_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'incoming_odd_id' => 'Incoming Odd ID',
            'parent_match_id' => 'Parent Match ID',
            'home_odd' => 'Home Odd',
            'neutral_odd' => 'Neutral Odd',
            'away_odd' => 'Away Odd',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentMatch() {
        return $this->hasOne(IncomingMatch::className(), ['parent_match_id' => 'parent_match_id']);
    }

    /**
     * @inheritdoc
     * @return IncomingOddQuery the active query used by this AR class.
     */
    public static function find() {
        return new IncomingOddQuery(get_called_class());
    }

    public static function getDb() {
        return Yii::$app->db2;
    }

}
