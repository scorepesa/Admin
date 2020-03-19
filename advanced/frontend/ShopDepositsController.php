<?php

namespace frontend\controllers;

use Yii;
use app\models\ShopDeposits;
use app\models\ShopDepositsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShopDepositsController implements the CRUD actions for ShopDeposits model.
 */
class ShopDepositsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all ShopDeposits models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopDepositsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShopDeposits model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ShopDeposits model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShopDeposits();

        if ($model->load(Yii::$app->request->post())) {

            $validMsisdn = '/^(254)7\d{8}$/';

            if(!preg_match($validMsisdn, $model->msisdn)) {

                Yii::$app->getSession()->setFlash('error', [
                    'message' => 'Number provided not valid!.'
                ]);

                return $this->redirect(['create']);
            }

            $code_obj = $model::find()
                                ->where('code = :code', [':code' => $model->code])
                                ->one();

            if(!$code_obj) {

                    // hash msisdn and time of transaction
                    $transactionTime = date('Y-m-d H:i:s');
                    $msisdn = $model->msisdn;

                    //$model->code = sha1($transactionTime.$msisdn);
                    $model->code =  $model->generateRandomString();

                    $airtel  =  '/^\+?(254|0)7[358]\d{7}/';
                    $equitel =  '/^\+?(254|0)7[6]\d{7}/';
                    $telcom  =  '/^\+?(254|0)7[7]\d{7}/';
                    $safcom  =  '/^\+?(254|0)7[01249]\d{7}/';

                    if(preg_match($airtel, $msisdn)) {
                       $model->network = 'AIRTEL';
                    } elseif(preg_match($safcom, $msisdn)) {
                        $model->network = 'SAFARICOM';
                    } elseif(preg_match($telcom, $msisdn)) {
                        $model->network = 'TELKOM';
                    } elseif(preg_match($equitel, $msisdn)) {
                        $model->network = 'EQUITEL';
                    }

                    $model->save(false);


                    return $this->redirect(['view', 'id' => $model->transaction_id]);

                } else {
                    $msg = "Deposit code already exixts";
                    $error = 'success';

                    Yii::$app->getSession()->setFlash($error, $msg);

                    return $this->redirect(['index']);
                }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing ShopDeposits model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->transaction_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ShopDeposits model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionApprovedeposit($id, $approvedBy) {
        // Some code here
        $model   = new ShopDeposits();
        $deposit = $model::find()
                        ->where('transaction_id = :id', [':id' => $id])
                        ->one();

        $msisdn    = $deposit->msisdn;
        $code      = $deposit->code;
        $amount    = $deposit->amount;
        $network   = $deposit->network;

        /* get first name and last name */
        $depositor = $deposit->depositor;
        $depositor = explode(' ', $depositor);
        $firstname = $depositor[0];
        $lastname  = $depositor[1];


        try {

            if($network == 'SAFARICOM') {
                /* push to deposits queue */
                $safaricomDataArray = array(
                    "TransType" => "Pay Bill",
                    "TransID" => $code,
                    "TransTime" => date('Y-m-d H:i:s'),
                    "TransAmount" => $amount,
                    "BusinessShortCode" => "290290-SHOP",
                    "BillRefNumber" => "101010",
                    "OrgAccountBalance" => "1312151.00",
                    "MSISDN" => $msisdn,
                    "KYCInfo" => array(
                        array(
                            "KYCName" => "[Personal Details][First Name]",
                            "KYCValue" => $firstname
                        ), array(
                            "KYCName" => "[Personal Details][Last Name]",
                            "KYCValue" => $lastname
                        )
                    ),
                );

                $message = json_encode($safaricomDataArray);

                $exchange  = 'SCOREPESA_DEPOSIT_MPESA_QUEUE';
                $queue     = 'SCOREPESA_DEPOSIT_MPESA_QUEUE';

                Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = true, $auto_delete = false);
                Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);

            } elseif($network == 'AIRTEL') {
                /* push to airtel queue */
                $timestamp = date('Y-m-d H:i:s');

                $airtelDataArray = array(

                    "Account" => "Scorepesasports",
                    "ReferenceID" => $code, 
                    /*"ReferenceID" =>  "29154524",*/
                    "FirstName" =>  $firstname,
                    "MSISDN" =>  $msisdn,
                    "OboAccount" =>  "30750439-SHOP",
                    "TimeStamp" =>  $timestamp,
                    "Amount" =>  $amount,
                    "LastName" =>  $lastname

                );

                $exchange = "AIRTELMONEY_C2B";
                $queue    = "AIRTELMONEY_C2B";

                Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = true, $auto_delete = false);
                Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);

                //print_r(json_encode($airtelDataArray));die();
            } else {
                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Shop handles safaricom and airtel numbers for deposits.'
                ]);

                return $this->redirect(['index']);
            }

                
            $result = $model->approveDeposit($id, $approvedBy);

            if($result) {

                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Deposit approved successfully.'
                ]);

                return $this->redirect(['index']);
            }

        } catch(Exception $e) {
                Yii::$app->getSession()->setFlash('error', [
                    'message' => 'Error in approving deposit.'
                ]);

                return $this->redirect(['index']);
        }

    }



    /**
     * Finds the ShopDeposits model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopDeposits the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopDeposits::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
