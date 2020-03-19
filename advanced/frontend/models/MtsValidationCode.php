<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mts_validation_code".
 *
 * @property integer $mts_validation_code_id
 * @property string $scenario
 * @property string $outcome
 * @property string $code
 * @property string $message
 * @property integer $mts_exception_id
 * @property string $created
 * @property string $modified
 */
class MtsValidationCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mts_validation_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scenario', 'outcome', 'code', 'created'], 'required'],
            [['scenario', 'message'], 'string'],
            [['mts_exception_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['outcome'], 'string', 'max' => 200],
            [['code'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mts_validation_code_id' => 'Mts Validation Code ID',
            'scenario' => 'Scenario',
            'outcome' => 'Outcome',
            'code' => 'Code',
            'message' => 'Message',
            'mts_exception_id' => 'Mts Exception ID',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
