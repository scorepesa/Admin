<?php

namespace frontend\controllers;

use Yii;
use app\models\ShopWithdrawals;
use app\models\ShopWithdrawalsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \Firebase\JWT\JWT;


/**
 * ShopWithdrawalsController implements the CRUD actions for ShopWithdrawals model.
 */
class ShopWithdrawalsController extends Controller
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
     * Lists all ShopWithdrawals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopWithdrawalsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShopWithdrawals model.
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
     * Creates a new ShopWithdrawals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShopWithdrawals();

        if ($model->load(Yii::$app->request->post())) {
            /* check for valid msisdn */

            /*
                Regex examples

                $airtel  =  '/^\+?(254|0)7[358]\d{7}/';
                $equitel =  '/^\+?(254|0)7[6]\d{7}/';
                $telcom  =  '/^\+?(254|0)7[7]\d{7}/';
                $safcom  =  '/^\+?(254|0)7[01249]\d{7}/';

                254 (0) 725 939 416

            */

            $validMsisdn = '/^(254)7\d{8}$/';

            if(!preg_match($validMsisdn, $model->msisdn)) {

                Yii::$app->getSession()->setFlash('error', [
                    'message' => 'Number provided not valid!.'
                ]);

                return $this->redirect(['create']);
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->withdrawal_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing ShopWithdrawals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->withdrawal_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ShopWithdrawals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    
    public function actionApprovewithdrawal($id, $approvedBy) {
        $model = new ShopWithdrawals();
        $withdrawal = $model::find()
                        ->where('withdrawal_id = :id', [':id' => $id])
                        ->one();

        // push to withdrawal queue
        $msisdn = $withdrawal->msisdn;
        $amount = $withdrawal->amount;


        $payload = array(
                    "user" => array(
                        "msisdn" => $msisdn,
                        "amount" => $amount
                    ));

        $key = "5eBOGiKXt7dsKwaaJcRX8owIH7BbJ8F9";

        // $token = json_encode($dataArray);

        $token = JWT::encode($payload, $key);

        $data = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"token\"\r\n\r\n".$token."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--";

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => "8008",
        CURLOPT_URL => "http://146.148.8.26:8008/macatm",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,

        CURLOPT_HTTPHEADER => array(
          "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {

                $msg = "Error in executing task... ".$err;
                $error = 'error';

                Yii::$app->getSession()->setFlash($error, $msg);
                return $this->redirect(['index']);

        } else {

            $withdrawalSuccessful = "Your request to withdraw Ksh";

            $withdraw = explode(' ', $response);

            $withdrawalSuccessfulMatch = $withdraw[0].' '.$withdraw[1].' '.$withdraw[2].' '.$withdraw[3].' '.$withdraw[4];

            // check curl response
            if($withdrawalSuccessful == $withdrawalSuccessfulMatch) {
                // approve
                // change status to 5
                $result = $model->approveWithdrawal($id, $approvedBy);

                if($result) {
                    $msg = "Withdrawal approved successfully... ".$response;
                    $error = 'success';

                    Yii::$app->getSession()->setFlash($error, $msg);

                    return $this->redirect(['index']);

                } else {
                    return $this->redirect('index');
                }

            } else {
             
                // cancel
                $result = $model->cancelWithdrawal($id, $approvedBy);
                $msg = $response;
                $error = 'error';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect(['index']);
            }

           
        }

    }




    /**
     * Finds the ShopWithdrawals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopWithdrawals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopWithdrawals::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
