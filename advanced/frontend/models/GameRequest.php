<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_request".
 *
 * @property integer $request_id
 * @property integer $match_id
 * @property integer $profile_id
 * @property integer $offset
 * @property string $created
 */
class GameRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_id', 'profile_id', 'offset'], 'required'],
            [['match_id', 'profile_id', 'offset'], 'integer'],
            [['created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_id' => 'Request ID',
            'match_id' => 'Match ID',
            'profile_id' => 'Profile ID',
            'offset' => 'Offset',
            'created' => 'Created',
        ];
    }

    /**
     * @inheritdoc
     * @return GameRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GameRequestQuery(get_called_class());
    }
}
