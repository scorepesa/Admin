<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "withdrawal".
 *
 * @property integer $withdrawal_id
 * @property integer $inbox_id
 * @property string $msisdn
 * @property string $raw_text
 * @property string $amount
 * @property string $reference
 * @property string $created
 * @property string $created_by
 * @property string $status
 * @property string $provider_reference
 * @property integer $number_of_sends
 * @property double $charge
 * @property double $max_withdraw
 * @property integer $network
 *
 * @property Inbox $inbox
 */
class Withdrawal extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'withdrawal';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['inbox_id', 'msisdn', 'amount', 'reference', 'created_by'], 'required'],
            [['inbox_id', 'number_of_sends'], 'integer'],
            [['amount', 'charge', 'max_withdraw'], 'number'],
            [['created', 'network'], 'safe'],
            [['status'], 'string'],
            [['msisdn'], 'string', 'max' => 25],
            [['raw_text'], 'string', 'max' => 200],
            [['reference'], 'string', 'max' => 70],
            [['created_by'], 'string', 'max' => 45],
            [['provider_reference'], 'string', 'max' => 250],
            [['inbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => Inbox::className(), 'targetAttribute' => ['inbox_id' => 'inbox_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'withdrawal_id' => 'Withdrawal ID',
            'inbox_id' => 'Inbox ID',
            'msisdn' => 'Msisdn',
            'raw_text' => 'Raw Text',
            'amount' => 'Amount',
            'reference' => 'Reference',
            'created' => 'Created',
            'created_by' => 'Created By',
            'status' => 'Status',
            'network' => 'Network',
            'provider_reference' => 'Provider Reference',
            'number_of_sends' => 'Number Of Sends',
            'charge' => 'Charge',
            'max_withdraw' => 'Max Withdraw',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInbox() {
        return $this->hasOne(Inbox::className(), ['inbox_id' => 'inbox_id']);
    }

}
