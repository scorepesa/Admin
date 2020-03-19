<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "airtel_money".
 *
 * @property integer $id
 * @property string $msisdn
 * @property string $account_no
 * @property string $airtel_money_code
 * @property string $first_name
 * @property string $last_name
 * @property string $amount
 * @property string $time_stamp
 * @property string $created
 * @property string $modified
 */
class AirtelMoney extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'airtel_money';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msisdn', 'account_no', 'airtel_money_code', 'first_name', 'last_name', 'amount', 'time_stamp', 'created'], 'required'],
            [['amount'], 'number'],
            [['time_stamp', 'created', 'modified'], 'safe'],
            [['msisdn'], 'string', 'max' => 30],
            [['account_no'], 'string', 'max' => 100],
            [['airtel_money_code'], 'string', 'max' => 50],
            [['first_name', 'last_name'], 'string', 'max' => 120],
            [['msisdn', 'airtel_money_code'], 'unique', 'targetAttribute' => ['msisdn', 'airtel_money_code'], 'message' => 'The combination of Msisdn and Airtel Money Code has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'msisdn' => 'Msisdn',
            'account_no' => 'Account No',
            'airtel_money_code' => 'Airtel Money Code',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'amount' => 'Amount',
            'time_stamp' => 'Time Stamp',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
