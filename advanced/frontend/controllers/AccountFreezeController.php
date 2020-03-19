<?php

namespace frontend\controllers;

use Yii;
use app\models\AccountFreeze;
use app\models\AccountFreezeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\db\Query;

/**
 * AccountFreezeController implements the CRUD actions for AccountFreeze model.
 */
class AccountFreezeController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AccountFreeze models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AccountFreezeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccountFreeze model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AccountFreeze model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AccountFreeze();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->account_freeze_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionPublishmq() {
        $exchange = 'SCOREPESA_WINNER_MESSAGES_QUEUE';
        $queue = 'SCOREPESA_WINNER_MESSAGES_QUEUE';
        $data = array(
            "refNo" => rand(10000, 9999999),
            "msisdn" => '254726986944',
            "message" => ""
        );
        $dataArray = array("queue.QMessage" => $data);
        $message = json_encode($dataArray);

        //Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
        //Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
        //Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
//        Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);
    }

    /**
     * Updates an existing AccountFreeze model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $delete_status = \app\models\AccountFreeze::find()
                    ->where('msisdn=:msisdn AND status=:status', [':msisdn' => $model->msisdn, ':status' => 0])
                    ->one();
            if ($delete_status):
                $delete_status->delete();
            endif;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $msisdn = $model->msisdn;

                /* insert into queue */
                $exchange = 'SCOREPESA_SENDSMS_EX';
                $queue = 'SCOREPESA_SENDSMS_QUEUE';
                /* fetch profile details */

                $profile_obj = \app\models\Profile::find()
                        ->where('msisdn = :msisdn', [':msisdn' => $msisdn])
                        ->one();
                if($profile_obj){
                    $profile_bal_obj = \app\models\ProfileBalance::find()
                        ->where('profile_id = :profile_id', [':profile_id' => $profile_obj->profile_id])
                        ->one();
                    $account_balance = isset($profile_bal_obj->balance) ? $profile_bal_obj->balance : 0;
                    /* construct message */
                    $sms = "Dear punter, Service for your Scorepesa.com account has been re-enabled. Scorepesas terms and conditions apply.";

                    $data = array(
                        "correlator" => $profile_obj->msisdn . "_" . rand(10000, 9999999),
                        "msisdn" => $profile_obj->msisdn,
                        "message" => $sms,
                        "exchange"=> "SCOREPESA_SENDSMS_EX"
                    );
                    $message = json_encode($data);

                //Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                //Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                //Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);
                }
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->account_freeze_id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } catch (Exception $e) {

            $transaction->rollback();
        }
    }

    /**
     * Deletes an existing AccountFreeze model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AccountFreeze model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccountFreeze the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AccountFreeze::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
