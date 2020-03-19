<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_deposits".
 *
 * @property integer $transaction_id
 * @property integer $msisdn
 * @property string $code
 * @property string $amount
 * @property string $network
 * @property string $depositor
 * @property string $created_by
 * @property string $approved_by
 * @property integer $status
 * @property string $created
 * @property string $modified
 */
class ShopDeposits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_deposits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msisdn', 'code', 'amount', 'depositor', 'created_by', 'created'], 'required'],
            [['msisdn', 'status'], 'integer'],
            [['amount'], 'number'],
            [['created', 'modified'], 'safe'],
            [['code', 'depositor'], 'string', 'max' => 100],
            [['network', 'created_by', 'approved_by'], 'string', 'max' => 45],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transaction_id' => 'Transaction ID',
            'msisdn' => 'Msisdn',
            'code' => 'Code',
            'amount' => 'Amount',
            'network' => 'Network',
            'depositor' => 'Depositor',
            'created_by' => 'Created By',
            'approved_by' => 'Approved By',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    public function approveDeposit($id,$approvedBy) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{

                $sql = "UPDATE shop_deposits SET status = 5, approved_by = '$approvedBy' WHERE transaction_id = '$id' ";

                $connection->createCommand($sql)->execute();

                $transaction->commit();

                return TRUE;

        } catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }

    }

    public function generateRandomString($length = 10) {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
