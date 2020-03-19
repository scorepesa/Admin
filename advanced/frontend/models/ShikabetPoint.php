<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scorepesa_point".
 *
 * @property integer $scorepesa_point_id
 * @property integer $profile_id
 * @property string $points
 * @property string $redeemed_amount
 * @property string $created_by
 * @property string $status
 * @property string $created
 * @property string $modified
 */
class ScorepesaPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scorepesa_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'points', 'redeemed_amount', 'created_by', 'status', 'created'], 'required'],
            [['profile_id'], 'integer'],
            [['points', 'redeemed_amount'], 'number'],
            [['status'], 'string'],
            [['created', 'modified'], 'safe'],
            [['created_by'], 'string', 'max' => 200],
            [['profile_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scorepesa_point_id' => 'Scorepesa Point ID',
            'profile_id' => 'Profile ID',
            'points' => 'Points',
            'redeemed_amount' => 'Redeemed Amount',
            'created_by' => 'Created By',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
