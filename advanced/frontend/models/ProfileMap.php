<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_map".
 *
 * @property integer $profile_map_id
 * @property integer $scorepesa_profile_id
 * @property integer $status
 * @property string $created
 * @property string $modified
 * @property string $created_by
 *
 * @property Bet[] $bets
 * @property Outbox[] $outboxes
 */
class ProfileMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_map';
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
            [['scorepesa_profile_id'], 'required'],
            [['scorepesa_profile_id', 'status'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['created_by'], 'string', 'max' => 45],
            [['scorepesa_profile_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profile_map_id' => 'Profile Map ID',
            'scorepesa_profile_id' => 'Scorepesa Profile ID',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBets()
    {
        return $this->hasMany(Bet::className(), ['profile_id' => 'scorepesa_profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutboxes()
    {
        return $this->hasMany(Outbox::className(), ['profile_id' => 'scorepesa_profile_id']);
    }
}
