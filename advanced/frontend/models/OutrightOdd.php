<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outright_odd".
 *
 * @property integer $odd_id
 * @property integer $parent_outright_id
 * @property integer $betradar_competitor_id
 * @property string $odd_type
 * @property string $odd_value
 * @property string $special_bet_value
 * @property integer $status
 * @property string $created_by
 * @property string $created
 * @property string $modified
 */
class OutrightOdd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outright_odd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_outright_id', 'betradar_competitor_id', 'odd_type', 'created_by', 'created'], 'required'],
            [['parent_outright_id', 'betradar_competitor_id', 'status'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['odd_type', 'odd_value'], 'string', 'max' => 20],
            [['special_bet_value'], 'string', 'max' => 10],
            [['created_by'], 'string', 'max' => 60],
            [['parent_outright_id', 'betradar_competitor_id', 'odd_type'], 'unique', 'targetAttribute' => ['parent_outright_id', 'betradar_competitor_id', 'odd_type'], 'message' => 'The combination of Parent Outright ID, Betradar Competitor ID and Odd Type has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'odd_id' => 'Odd ID',
            'parent_outright_id' => 'Parent Outright ID',
            'betradar_competitor_id' => 'Betradar Competitor ID',
            'odd_type' => 'Odd Type',
            'odd_value' => 'Odd Value',
            'special_bet_value' => 'Special Bet Value',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
