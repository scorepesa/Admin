<?php

namespace frontend\controllers;

use Yii;
use app\models\MpesaTransaction;
use app\models\MpesaTransactionSearch;
use app\models\UploadXlsForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * MpesaTransactionController implements the CRUD actions for MpesaTransaction model.
 */
class MpesaTransactionController extends Controller {

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
     * Lists all MpesaTransaction models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MpesaTransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $excel_model = new UploadXlsForm();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'excel_model' => $excel_model
        ]);
    }

    /**
     * Displays a single MpesaTransaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MpesaTransaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        /*        $model = new MpesaTransaction();
          try {

          if ($model->load(Yii::$app->request->post())) {
          $mpesa_obj = $model::find()
          ->where('mpesa_code = :mpesa_code', [':mpesa_code' => $model->mpesa_code])
          ->one();
          if (!$mpesa_obj):

          /* push to withdraw queue */
        /*         $dataArray = array(
          "TransType" => "Pay Bill",
          "TransID" => $model->mpesa_code,
          "TransTime" => date('Y-m-d H:i:s'),
          "TransAmount" => $model->mpesa_amt,
          "BusinessShortCode" => "290290",
          "BillRefNumber" => "scorepesa",
          "OrgAccountBalance" => "1312151.00",
          "MSISDN" => $model->msisdn,
          "KYCInfo" => array(
          array(
          "KYCName" => "[Personal Details][First Name]",
          "KYCValue" => $model->mpesa_sender
          ), array(
          "KYCName" => "[Personal Details][Last Name]",
          "KYCValue" => $model->mpesa_sender
          )
          ),
          );

          $exchange = 'SCOREPESA_DEPOSIT_MPESA_QUEUE';
          $queue = 'SCOREPESA_DEPOSIT_MPESA_QUEUE';
          $message = json_encode($dataArray);

          Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = true, $auto_delete = false);
          Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
          Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
          Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);

          Yii::$app->getSession()->setFlash('success', [
          'message' => 'Operation succeded.'
          ]);

          else:
          Yii::$app->getSession()->setFlash('error', [
          'message' => 'Operation failed. Mpesa code already exists.'
          ]);
          endif;
          return $this->render('create', [
          'model' => $model,
          ]);
          } else {
          return $this->render('create', [
          'model' => $model,
          ]);
          }
          } catch (yii\db\IntegrityException $exc) {
          Yii::error("EXCEPTION create mpesa transaction ::" . $exc->getMessage());
          Yii::$app->getSession()->setFlash('error', [
          'message' => 'Operation failed, create mpesa transaction failed. Please try again later or contact Tech.'
          ]);
          return $this->render('create', [
          'model' => $model,
          ]);
          } */
    }

    /**
     * Updates an existing MpesaTransaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->mpesa_transaction_id]);
          } else { */
        Yii::$app->getSession()->setFlash('error', [
            'message' => 'Operation violation. Update on Mpesa transaction not allowed.'
        ]);
        return $this->render('update', [
                    'model' => $model,
        ]);
//        }
    }

    /**
     * Deletes an existing MpesaTransaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('error', [
            'message' => 'Operation violation. Update on Mpesa transaction not allowed.'
        ]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the MpesaTransaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MpesaTransaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MpesaTransaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUploadxls() {
        $model = new UploadXlsForm();
        $tour_id = 1;

        if (Yii::$app->request->isPost) {
            $model->mediaFile = UploadedFile::getInstance($model, 'mediaFile');
            if ($model->upload()) {
                // file is uploaded successfully
                $outputfile = \Yii::getAlias('@frontend/runtime/logs/nohup_web.out');
                $cmd = "python /scripts/deposit_rerun.py";
                '<code>' . exec(sprintf("%s >> %s 2>&1 & echo $!", $cmd, $outputfile), $pidArr) . '</code>';
            
                Yii::$app->getSession()->setFlash('success', [
                   'message' => 'Operation success'
                ]);
                return $this->render('uploadxls', [
                            'model' => $model, 'id' => $tour_id
                ]);
            }
        }

        return $this->render('uploadxls', [
                    'model' => $model, 'id' => $tour_id
        ]);
    }

    /*public function actionUploadxls() {
        $model = new UploadXlsForm();
        $tour_id = 1;

        if (Yii::$app->request->isPost) {

            $model->mediaFile = UploadedFile::getInstance($model, 'mediaFile');

            $name = $_FILES['UploadXlsForm']['name']['mediaFile'];
            $type = $_FILES['UploadXlsForm']['type']['mediaFile'];
            $size = $_FILES['UploadXlsForm']['size']['mediaFile'];
            $tmp_name = $_FILES['UploadXlsForm']['tmp_name']['mediaFile'];

            $ftp_server = '';
            $ftp_user_name = 'kennyweche';
            $ftp_user_pass = 'portmore254';


            // set up basic connection
            $conn_id = ftp_ssl_connect($ftp_server);

            $name = "/var/www/html/uploads/".$name;

            // login with username and password
            $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

            // upload a file
            if (ftp_put($conn_id, $name, $tmp_name, FTP_ASCII)) {
                $msg =  "File uploaded successfull at $name\n";
                $error = 'success';
            } else {
                $msg = "There was a problem while uploading $name\n";
                $error = 'error';
            }

            // close the connection
            ftp_close($conn_id);

            Yii::$app->getSession()->setFlash($error, $msg);

             return $this->render('uploadxls', [
                        'model' => $model, 'id' => $tour_id
            ]);
            
        }

        return $this->render('uploadxls', [
                    'model' => $model, 'id' => $tour_id
        ]);
    }*/

    public function actionRunxls() {
        $model = new UploadXlsForm();

        if (Yii::$app->request->isPost) {
            //run nohup
            $outputfile = \Yii::getAlias('@frontend/runtime/logs/nohup_web.out');
            $cmd = "python /scripts/deposit_rerun.py";
//            $output = exec('sh /apps/python/pyadminscripts/pyadminscripts/depo.sh');
            '<code>' . exec(sprintf("%s >> %s 2>&1 & echo $!", $cmd, $outputfile), $pidArr) . '</code>';
            /* $descriptorspec = array(
              0 => array("pipe", "r"), // stdin
              1 => array("pipe", "w"), // stdout
              2 => array("pipe", "w")   // stderr
              );
              $cmd = "sh /apps/python/pyadminscripts/pyadminscripts/depo.sh";
              $process = proc_open($cmd, $descriptorspec, $pipes);
              sleep(1);
              proc_close($process); */
            Yii::info("Run mpesa deposit excel file:: $pidArr[0]");

            Yii::$app->getSession()->setFlash('success', [
                'message' => 'Operation success.'
            ]);
        }
        $model->run =1;
        return $this->render('_run_xls_processor', [
                    'model' => $model
        ]);
    }

    public function actionLogviewer() {
        $model = new UploadXlsForm();

        return $this->render('logviewer', [
                    'model' => $model
        ]);
    }

}
