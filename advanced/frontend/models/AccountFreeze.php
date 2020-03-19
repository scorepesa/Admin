<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_freeze".
 *
 * @property integer $account_freeze_id
 * @property string $msisdn
 * @property integer $status
 * @property string $created
 * @property string $modified
 */
class AccountFreeze extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_freeze';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msisdn', 'created'], 'required'],
            [['status'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['msisdn'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_freeze_id' => 'Account Freeze ID',
            'msisdn' => 'Msisdn',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
