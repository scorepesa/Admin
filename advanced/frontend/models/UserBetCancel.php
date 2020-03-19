<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_bet_cancel".
 *
 * @property integer $id
 * @property integer $bet_id
 * @property integer $status
 * @property string $created_by
 * @property string $created
 * @property string $modified
 */
class UserBetCancel extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user_bet_cancel';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['bet_id', 'status', 'created_by'], 'required'],
            [['status'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['created_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'bet_id' => 'Bet ID',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    public function updateBets($data, $created_by) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $data1 = explode(',', $data);
            foreach ($data1 as $value) {
                if ((int) $value > 0) {
//                $created_by = "Ronoh";
                    $status = 0;

                    $sql1 = "INSERT INTO user_bet_cancel(bet_id,status,created_by)  VALUES('$value','$status','$created_by')";
                    $connection->createCommand($sql1)->execute();

                    // $sql2 = "UPDATE bet SET status = 24 WHERE bet_id = '$value' ";
                    // $connection->createCommand($sql2)->execute();
                }
            }

            $transaction->commit();
            return TRUE;
        } catch (Exception $exc) {
            $transaction->rollback();
            return FALSE;
        }
    }

    /* public function cancelBet($bet_id) {
      $connection = \Yii::$app->db;
      $transaction = $connection->beginTransaction();
      try{

      $status = 24;

      $sql = "UPDATE bet SET status = 24 WHERE bet_id = '$bet_id' ";
      $connection->createCommand($sql)->execute();

      $transaction->commit();
      return TRUE;
      } catch (Exception $exc) {
      $transaction->rollback();
      return FALSE;
      }


      } */
}
