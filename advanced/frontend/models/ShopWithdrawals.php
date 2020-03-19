<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_withdrawals".
 *
 * @property integer $withdrawal_id
 * @property string $msisdn
 * @property string $amount
 * @property string $created_by
 * @property string $approved_by
 * @property integer $status
 * @property string $created
 * @property string $modified
 */
class ShopWithdrawals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_withdrawals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msisdn', 'amount', 'created_by'], 'required'],
            [['amount'], 'number'],
            [['status'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['msisdn'], 'string', 'max' => 25],
            [['created_by', 'approved_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'withdrawal_id' => 'Withdrawal ID',
            'msisdn' => 'Msisdn',
            'amount' => 'Amount',
            'created_by' => 'Created By',
            'approved_by' => 'Approved By',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    public function approveWithdrawal($id,$approvedBy) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{

                $sql = "UPDATE shop_withdrawals SET status = 5, approved_by = '$approvedBy' WHERE withdrawal_id = '$id' ";

                $connection->createCommand($sql)->execute();

                $transaction->commit();

                return TRUE;

        } catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }

    }

    public function cancelWithdrawal($id,$approvedBy) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{

                $sql = "UPDATE shop_withdrawals SET status = 7, approved_by = '$approvedBy' WHERE withdrawal_id = '$id' ";

                $connection->createCommand($sql)->execute();

                $transaction->commit();

                return TRUE;

        } catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }

    }

}
