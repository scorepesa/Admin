<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outright_outcome".
 *
 * @property integer $outcome_id
 * @property integer $parent_outright_id
 * @property integer $betradar_competitor_id
 * @property string $odd_type
 * @property string $special_bet_value
 * @property string $outcome
 * @property integer $status
 * @property string $created_by
 * @property string $created
 * @property string $modified
 */
class OutrightOutcome extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outright_outcome';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_outright_id', 'betradar_competitor_id', 'outcome', 'created_by', 'created'], 'required'],
            [['parent_outright_id', 'betradar_competitor_id', 'status'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['odd_type'], 'string', 'max' => 20],
            [['special_bet_value'], 'string', 'max' => 10],
            [['outcome', 'created_by'], 'string', 'max' => 60],
            [['parent_outright_id', 'betradar_competitor_id'], 'unique', 'targetAttribute' => ['parent_outright_id', 'betradar_competitor_id'], 'message' => 'The combination of Parent Outright ID and Betradar Competitor ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'outcome_id' => 'Outcome ID',
            'parent_outright_id' => 'Parent Outright ID',
            'betradar_competitor_id' => 'Betradar Competitor ID',
            'odd_type' => 'Odd Type',
            'special_bet_value' => 'Special Bet Value',
            'outcome' => 'Outcome',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
