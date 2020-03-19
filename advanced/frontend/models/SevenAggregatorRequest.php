<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seven_aggregator_request".
 *
 * @property int $id
 * @property string $amount
 * @property string $request_name
 * @property string $amount_small
 * @property string $currency
 * @property string $user
 * @property string $payment_strategy
 * @property string $transactionType
 * @property string $payment_id
 * @property string $transaction_id
 * @property string $source_id
 * @property string $reference_id
 * @property string $tp_token
 * @property string $ticket_info
 * @property string $security_hash
 * @property string $club_uuid
 * @property int $status
 * @property string $aggregator_status
 * @property string $created_by
 * @property string $date_created
 * @property string $date_modified
 */
class SevenAggregatorRequest extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'seven_aggregator_request';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['amount', 'request_name', 'amount_small', 'currency', 'user', 'payment_id', 'source_id', 'reference_id', 'club_uuid', 'created_by', 'date_created'], 'required'],
            [['amount'], 'number'],
            [['amount_small', 'status'], 'integer'],
            [['payment_strategy', 'transactionType', 'tp_token', 'ticket_info', 'aggregator_status'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['request_name', 'payment_id', 'transaction_id', 'created_by'], 'string', 'max' => 200],
            [['currency'], 'string', 'max' => 50],
            [['user'], 'string', 'max' => 100],
            [['source_id', 'reference_id', 'security_hash', 'club_uuid'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'request_name' => 'Request Name',
            'amount_small' => 'Amount Small',
            'currency' => 'Currency',
            'user' => 'User',
            'payment_strategy' => 'Payment Strategy',
            'transactionType' => 'Transaction Type',
            'payment_id' => 'Payment ID',
            'transaction_id' => 'Transaction ID',
            'source_id' => 'Source ID',
            'reference_id' => 'Reference ID',
            'tp_token' => 'Tp Token',
            'ticket_info' => 'Ticket Info',
            'security_hash' => 'Security Hash',
            'club_uuid' => 'Club Uuid',
            'status' => 'Status',
            'aggregator_status' => 'Aggregator Status',
            'created_by' => 'Created By',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
        ];
    }

    public function getProfile() {
        return $this->hasOne(Profile::className(), ['profile_id' => 'user']);
    }

    public function getProfileName() {
        return $this->profile->msisdn;
    }

}
