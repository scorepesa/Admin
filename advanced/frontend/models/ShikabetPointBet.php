<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scorepesa_point_bet".
 *
 * @property integer $scorepesa_point_bet_id
 * @property integer $bet_id
 * @property integer $scorepesa_point_trx_id
 * @property double $points
 * @property string $amount
 * @property string $created_by
 * @property string $created
 * @property string $modified
 */
class ScorepesaPointBet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scorepesa_point_bet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bet_id', 'scorepesa_point_trx_id', 'points', 'amount', 'created_by', 'created'], 'required'],
            [['bet_id', 'scorepesa_point_trx_id'], 'integer'],
            [['points', 'amount'], 'number'],
            [['created', 'modified'], 'safe'],
            [['created_by'], 'string', 'max' => 200],
            [['bet_id', 'scorepesa_point_trx_id'], 'unique', 'targetAttribute' => ['bet_id', 'scorepesa_point_trx_id'], 'message' => 'The combination of Bet ID and Scorepesa Point Trx ID has already been taken.'],
            [['bet_id'], 'unique'],
            [['scorepesa_point_trx_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScorepesaPointTrx::className(), 'targetAttribute' => ['scorepesa_point_trx_id' => 'scorepesa_point_trx_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scorepesa_point_bet_id' => 'Scorepesa Point Bet ID',
            'bet_id' => 'Bet ID',
            'scorepesa_point_trx_id' => 'Scorepesa Point Trx ID',
            'points' => 'Points',
            'amount' => 'Amount',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
