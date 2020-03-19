<?php

namespace frontend\controllers;

use Yii;
use app\models\Withdrawal;
use app\models\WithdrawalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WithdrawalController implements the CRUD actions for Withdrawal model.
 */
class WithdrawalController extends Controller {

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
     * Lists all Withdrawal models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new WithdrawalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Withdrawal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Withdrawal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Withdrawal();

        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->withdrawal_id]);
          } else { */
        return $this->render('create', [
                    'model' => $model,
        ]);
//        }
    }

    /**
     * Updates an existing Withdrawal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        try {
            $connection = \Yii::$app->db;
            if ($model->load(Yii::$app->request->post())) {
                
                $model->reference = $model->withdrawal_id . "-" . $model->msisdn;
                $insert = "insert into withdrawal (withdrawal_id, inbox_id, msisdn, raw_text, amount, "
                    . " reference, created, created_by, status, response_status, provider_reference, "
                    . " number_of_sends, charge, max_withdraw, network) values("
                    . " null, null, $model->msisdn, '$model->reference', $model->amount, '$model->reference', "
                    . " now(), 'admin-p', 'TRX_SUCCESS', null, null, 0, 0, 200000, '$model->network');";
                Yii::$app->db->createCommand($insert)->execute();
                $id = Yii::$app->db->getLastInsertID();
                
                $url = 'http://35.187.20.191:1580/queue/process' ;
		$curl = curl_init($url);
		$curl_post_data = array(
			'queueType' => 'MPESA_WITHDRAWAL',
			'created' => $model->created,
                        'msisdn'=>$model->msisdn,
                        'charge'=>0,
                        'amount'=>floor($model->amount),
                        'refNo'=>$id . "_" . $model->msisdn,
                        'withdrawal_id'=>$id,
                        'request_amount' =>floor($model->amount) 
		);
                $data_string = json_encode($curl_post_data); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',                                                                                
                    'Content-Length: ' . strlen($data_string))                                                                       
                );    

		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		    Yii::$app->getSession()->setFlash('error', [
                        'message' => 'Error occurred attempting to reprocess withdraw. Try again later'
                    ]);
		}
		curl_close($curl);
		$decoded = json_decode($curl_response);
                $sql = "UPDATE withdrawal set status='FAILED', reference='$model->reference'"
                            . " WHERE withdrawal_id=$model->withdrawal_id AND msisdn='$model->msisdn'";
                Yii::$app->db->createCommand($sql)->execute();

		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                    Yii::$app->getSession()->setFlash('error', [
                        'message' => $curl_response
                    ]);

		}
                $message = json_encode($decoded);
                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Operation reversal succeded.'
                ]);
                return $this->redirect(['view', 'id' => $model->withdrawal_id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } catch (yii\base\ErrorException $exc) {
            Yii::error("EXCEPTION withdrawal retry ::" . $exc->getMessage());
            Yii::$app->getSession()->setFlash('error', [
                'message' => 'Operation failed, withdraw reversal request could not be completed. Please try again later or contact Tech.'
            ]);
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionBulkretry() {
        $model = new Withdrawal();
        $from = '2017-03-02 12:16:39';
        $to = '2017-03-02 19:10:42';
        $ntwk = 'SAFARICOM';
        $ststs = 'FAILED';
        $data = $model->findBySql("SELECT * FROM withdrawal WHERE status='$ststs' AND network='$ntwk' AND created BETWEEN '$from' AND '$to' AND reference=''")
                ->all();

        foreach ($data as $value) {

            /* push to withdraw queue */
        }

        Yii::$app->getSession()->setFlash('success', [
            'message' => 'Operation bulk reversal finished.'
        ]);

        return $this->render('bulk-retry', [
                    'model' => $model
        ]);
    }

    /**
     * Deletes an existing Withdrawal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
//        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Withdrawal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Withdrawal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Withdrawal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLogsviewer() {
        $model = new Withdrawal();
        $html = "";
        $url = "http://197.248.6.28/logviewer/index.php";
        if (Yii::$app->request->isPost) {
            $output = $this->logviewerApi($model->withdraw_id, $model->msisdn, $url);
            $html = 'Withdraw';
            $html .='<table style="width:100%;border:1px solid black;">';
            foreach ($output as $key => $value) {
                $html .= '<tr><td>';
                print_r($value);
                $html .='</td></tr>';
            }
            $html .='</table>';
        }

        return $this->render('_run_xls_processor', [
                    'model' => $model,
                    'html_body' => $html
        ]);
    }

    public function logviewerApi($withdraw_id, $msisdn, $url) {
        try {
            $ch = curl_init();

            $data = array(
                "withdraw_id" => $withdraw_id,
                "msisdn" => $msisdn
            );
            //set the url, number of POST vars, POST data

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($data)));

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

            //execute post

            $curl_result = curl_exec($ch);

            //print_r($curl_result);
            $info = curl_getinfo($ch);
            //close connection

            curl_close($ch);

            return $curl_result;
        } catch (Exception $exc) {
            return null;
        }
    }

}
