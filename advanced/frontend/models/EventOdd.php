<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_odd".
 *
 * @property integer $event_odd_id
 * @property integer $parent_match_id
 * @property integer $sub_type_id
 * @property double $max_bet
 * @property double $odd_key
 * @property double $odd_value
 * @property string $odd_alias
 * @property string $created
 * @property string $modified

 */
class EventOdd extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'event_odd';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_match_id', 'sub_type_id', 'max_bet', 'odd_key', 'odd_value', 'odd_alias', 'created'], 'required'],
            [['parent_match_id', 'sub_type_id'], 'integer'],
            [['max_bet'], 'number'],
            [['created', 'modified'], 'safe'],
            [['parent_match_id'], 'exist', 'skipOnError' => true, 'targetClass' => Match::className(), 'targetAttribute' => ['parent_match_id' => 'parent_match_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {

        return [
            'event_odd_id' => 'Event Odd ID',
            'parent_match_id' => 'Parent Match ID',
            'sub_type_id' => 'Sub Type ID',
            'max_bet' => 'Max bet',
            'created' => 'Created',
            'modified' => 'Modified',
            'odd_key' => 'Odd Key',
            'odd_value' => 'Odd Value',
            'odd_alias' => 'Odd Alias'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch() {
        return $this->hasOne(Match::className(), ['parent_match_id' => 'parent_match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBetType() {
        return $this->hasOne(BetType::className(), ['sub_type_id' => 'sub_type_id']);
    }

    /**
     * @inheritdoc
     * @return EventOddQuery the active query used by this AR class.
     */
    public static function find() {
        return new EventOddQuery(get_called_class());
    }

}
