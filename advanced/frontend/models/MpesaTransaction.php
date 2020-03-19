<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mpesa_transaction".
 *
 * @property integer $mpesa_transaction_id
 * @property integer $msisdn
 * @property string $transaction_time
 * @property string $message
 * @property string $mpesa_customer_id
 * @property string $account_no
 * @property string $mpesa_code
 * @property string $mpesa_amt
 * @property string $mpesa_sender
 * @property integer $business_number
 * @property string $enc_params
 * @property string $created
 * @property string $modified
 */
class MpesaTransaction extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'mpesa_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['msisdn', 'transaction_time', 'message', 'mpesa_customer_id', 'account_no', 'mpesa_code', 'mpesa_amt', 'mpesa_sender', 'business_number', 'created'], 'required'],
            [['msisdn', 'business_number', 'mpesa_amt'], 'integer'],
            [['enc_params', 'created', 'modified'], 'safe'],
            [['account_no', 'mpesa_code', 'mpesa_sender'], 'string', 'max' => 100],
            [['message'], 'string', 'max' => 300],
            [['mpesa_customer_id'], 'string', 'max' => 50],
            [['enc_params'], 'string', 'max' => 250],
            [['mpesa_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'mpesa_transaction_id' => 'Mpesa Transaction ID',
            'msisdn' => 'Mobile number that deposited',
            'transaction_time' => 'Set date time as transaction time',
            'message' => 'Message just enter Mpesa Receipt code',
            'mpesa_customer_id' => 'Mpesa Receipt code',
            'account_no' => 'Account No e.g Scorepesa',
            'mpesa_code' => 'Mpesa Receipt code',
            'mpesa_amt' => 'Mpesa Amount',
            'mpesa_sender' => 'Mpesa Sender Firstname and Lastname',
            'business_number' => 'Paybill Number i.e 290290',
            'enc_params' => 'Enc Params',
            'created' => 'Date time',
            'modified' => 'Date time',
        ];
    }

    /**
     * @inheritdoc
     * @return MpesaTransactionQuery the active query used by this AR class.
     */
    public static function find() {
        return new MpesaTransactionQuery(get_called_class());
    }

}
