<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $account
 * @property integer $iscredit
 * @property string $reference
 * @property string $amount
 * @property string $running_balance
 * @property string $created_by
 * @property string $created
 * @property string $modified
 *
 * @property Profile $profile
 */
class Transaction extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['profile_id', 'account', 'iscredit', 'reference', 'amount', 'created_by', 'created'], 'required'],
            [['profile_id', 'iscredit'], 'integer'],
            [['amount', 'running_balance'], 'number'],
            [['created', 'modified'], 'safe'],
            [['account', 'reference'], 'string', 'max' => 50],
            [['created_by'], 'string', 'max' => 60],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'profile_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'profile_id' => 'Profile ID',
            'account' => 'Account',
            'iscredit' => 'Iscredit',
            'reference' => 'Reference',
            'amount' => 'Amount',
            'running_balance' => 'Running Balance',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile() {
        return $this->hasOne(Profile::className(), ['profile_id' => 'profile_id']);
    }

    /**
     * @inheritdoc
     * @return TransactionQuery the active query used by this AR class.
     */
    public static function find() {
        return new TransactionQuery(get_called_class());
    }

    public function fetchDailySummary() {
        $data = array();
        $sql = "SELECT count(profile_id)totalsubscribers,(SELECT SUM(mpesa_amt) AS mpltot "
                . "FROM (SELECT mpesa_amt FROM mpesa_transaction mpl UNION ALL "
                . "SELECT mpesa_amt FROM mpesa_transaction_archive mpa) t)deposits,"
                . "(SELECT SUM(amount) FROM withdrawal WHERE status IN "
                . "('SUCCESS','SENT','PROCESSING','QUEUED'))allwithdrawals,"
                . "(SELECT SUM(amount) FROM withdrawal "
                . "WHERE status = 'SUCCESS')confirmedWithdrawals,"
                . "(SELECT SUM(balance) FROM profile_balance "
                . "WHERE profile_id NOT IN (6,5))virtualbalance,"
                . "(SELECT SUM(bonus_balance) "
                . "FROM profile_balance)virtualbonus,curdate() as timeline FROM "
                . "profile p WHERE p.status=1 or p.status=0";

        $rows = Yii::$app->db->createCommand($sql)->queryAll();
        $count = count($rows);

        $provider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['deposits', 'allwithdrawals', 'confirmedWithdrawals', 'virtualbalance',
                    'virtualbonus']
            ],
        ]);
        $provider->getModels();
        return $provider;
    }

    /**
     * 
     * @param type $_amount
     * @param type $_account
     * @param type $trx_ref
     * @param type $profile_id
     * @param type $iscredit
     * @return boolean
     */
    public function create_manual_trx($_amount, $_account, $trx_ref, $profile_id, $iscredit) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $connection->createCommand()
                    ->batchInsert('transaction', ['amount', 'account',
                        'created', 'created_by', 'iscredit', 'profile_id',
                        'running_balance', 'reference'], [
                        [$_amount, $_account,
                            date('Y-m-d H:i:s'), Yii::$app->name, $iscredit, $profile_id,
                            $_amount, $trx_ref]
                    ])
                    ->execute();
            if ($iscredit == 1):
                $pb_sql = "INSERT INTO profile_balance(profile_id, balance,"
                        . "transaction_id,created,modified,bonus_balance)  "
                        . "VALUES($profile_id, $_amount, -1, now(), now(), 0)"
                        . "ON DUPLICATE KEY UPDATE balance=(balance + $_amount)";
                $connection->createCommand($pb_sql)->execute();
            else:
                //debit
                $upb_sql = "UPDATE profile_balance SET balance=(balance - $_amount)"
                        . " WHERE profile_id=$profile_id LIMIT 1";
                $connection->createCommand($upb_sql)->execute();
            endif;

            $transaction->commit();
            return TRUE;
        } catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }
    }

    public function fetch_profile_details($msisdn) {
        $rows = (new \yii\db\Query())
                ->select(["*"])
                ->from('profile')
                ->where("msisdn = $msisdn")
                ->all();
//                ->createCommand();
//        echo print_r($rows->sql);
//        die();
        return $rows;
    }

}
