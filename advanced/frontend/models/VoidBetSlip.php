<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "void_bet_slip".
 *
 * @property integer $bet_slip_id
 * @property integer $parent_match_id
 * @property integer $bet_id
 * @property string $bet_pick
 * @property string $special_bet_value
 * @property integer $total_games
 * @property string $odd_value
 * @property integer $win
 * @property string $created
 * @property string $modified
 * @property integer $status
 * @property integer $sub_type_id
 */
class VoidBetSlip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'void_bet_slip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_match_id', 'bet_id', 'bet_pick', 'total_games', 'odd_value', 'win', 'created', 'status', 'sub_type_id'], 'required'],
            [['parent_match_id', 'bet_id', 'total_games', 'win', 'status', 'sub_type_id'], 'integer'],
            [['odd_value'], 'number'],
            [['created', 'modified'], 'safe'],
            [['bet_pick', 'special_bet_value'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bet_slip_id' => 'Bet Slip ID',
            'parent_match_id' => 'Parent Match ID',
            'bet_id' => 'Bet ID',
            'bet_pick' => 'Bet Pick',
            'special_bet_value' => 'Special Bet Value',
            'total_games' => 'Total Games',
            'odd_value' => 'Odd Value',
            'win' => 'Win',
            'created' => 'Created',
            'modified' => 'Modified',
            'status' => 'Status',
            'sub_type_id' => 'Sub Type ID',
        ];
    }
}
