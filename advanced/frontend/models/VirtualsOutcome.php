<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outcome".
 *
 * @property integer $v_match_result_id
 * @property integer $sub_type_id
 * @property integer $parent_virtual_id
 * @property string $special_bet_value
 * @property integer $live_bet
 * @property string $created_by
 * @property string $created
 * @property string $modified
 * @property integer $status
 * @property string $approved_by
 * @property integer $approved_status
 * @property string $date_approved
 * @property string $winning_outcome
 */
class VirtualsOutcome extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'virtual_outcome';
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
            [['sub_type_id', 'parent_virtual_id', 'created_by', 'created', 'winning_outcome'], 'required'],
            [['sub_type_id', 'parent_virtual_id', 'live_bet', 'status', 'approved_status'], 'integer'],
            [['created', 'modified', 'date_approved'], 'safe'],
            [['special_bet_value'], 'string', 'max' => 20],
            [['created_by', 'approved_by'], 'string', 'max' => 70],
            [['winning_outcome'], 'string', 'max' => 200],
            [['parent_virtual_id', 'sub_type_id', 'winning_outcome', 'special_bet_value'], 'unique', 'targetAttribute' => ['parent_virtual_id', 'sub_type_id', 'winning_outcome', 'special_bet_value'], 'message' => 'The combination of Sub Type ID, Parent Match ID, Special Bet Value and Winning Outcome has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'v_match_result_id' => 'Match Result ID',
            'sub_type_id' => 'Sub Type ID',
            'parent_virtual_id' => 'Parent Virtual ID',
            'special_bet_value' => 'Special Bet Value',
            'live_bet' => 'Live Bet',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
            'status' => 'Status',
            'approved_by' => 'Approved By',
            'approved_status' => 'Approved Status',
            'date_approved' => 'Date Approved',
            'winning_outcome' => 'Winning Outcome',
        ];
    }
}
