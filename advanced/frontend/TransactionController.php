<?php

namespace frontend\controllers;

use Yii;
use app\models\Transaction;
use app\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller {

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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Transaction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionManualtrx() {
        $model = new Transaction();
        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            $data = $model->fetch_profile_details($model->profile_id);

            $profile_id = $data[0]['profile_id'];
            $model->account = $profile_id . "_VIRTUAL";
            $result = $model->create_manual_trx($model->amount, $model->account, $model->reference, $profile_id, $model->iscredit);
            if ($result):
                $sms = "Dear punter, Your Scorepesa.com account has been credited KSH $model->amount. Scorepesas terms and conditions apply.";
                $exchange = 'SCOREPESA_SENDSMS_EX';
                $queue = 'SCOREPESA_SENDSMS_QUEUE';
                $data = array(
                        "correlator" => $model->profile_id. "_" . rand(10000, 9999999),
                        "msisdn" => $model->profile_id,
                        "message" => $sms,
                        "exchange"=> "SCOREPESA_SENDSMS_EX"
                );
                $message = json_encode($data);

                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);

                $msg = "Operation success.";
                $error = 'success';
                Yii::$app->getSession()->setFlash($error, $msg);
                return $this->render('create', [
                            'model' => $model,
                ]);
            endif;
            $msg = "Operation failed.";
            $error = 'error';
            Yii::$app->getSession()->setFlash($error, $msg);
            return $this->redirect(['view']);
        }else {
            return $this->render('createtrx', [
                        'model' => $model,
            ]);
        }
    }

}
