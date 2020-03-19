<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\UploadApkForm;
use app\models\BetMaster;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
               'class' => 'common\components\MathCaptchaAction',
               'fixedVerifyCode' => YII_ENV_TEST ? '42' : null,
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $this->redirect(['site/dashboard']);
        $this->layout = '_main';
        if (\Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
        }
    }

    /**
     * Scorepesa app Publisher
     *
     * @return mixed
     */
    public function actionBapkUpload() {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new UploadApkForm();

        if (Yii::$app->request->isPost) {
            $model->apkFile = UploadedFile::getInstance($model, 'apkFile');
            if ($model->upload()) {
                // file is uploaded successfully
                Yii::$app->session->setFlash('info', 'APK uploaded next publish it.');
            }
        }

        return $this->render('scorepesa_app', [
                    'model' => $model
        ]);
    }

    public function actionBapkPublish() {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new UploadApkForm();
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_PORT => "8080",
                CURLOPT_URL => "http://pr-web-1:8080/scorepesaApp/android",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST"
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                Yii::$app->session->setFlash('error', 'There was an error publishing apk.');
            } else {
                Yii::$app->session->setFlash('success', 'APK publish success.');
            }
            return $this->render('scorepesa_app', [
                        'model' => $model
            ]);
        } catch (Exception $exc) {
            Yii::$app->session->setFlash('error', 'Error while publishing apk contact admin.');
            return $this->render('scorepesa_app', [
                        'model' => $model
            ]);
//            echo $exc->getTraceAsString();
        }
    }


    public function actionDashboard(){
       $model = new BetMaster();
       return $this->render('dashboard', ['model'=>$model]); 
    }

    public function actionBetStats(){
        $model = new BetMaster();
        $bet_stats = $model->latestBetStats();
        $dates = [];
        $fin_data = [];
        $row_data = []; 
        $row_data[0]= []; //array("name"=>'Bets', 'data'=>[]); 
	$row_data[1]=[]; // array("name"=>'Paid', 'data'=>[]);; 
	$row_data[2]= []; //array("name"=>'Lost', 'data'=>[]);; 
	$row_data[3]= []; //array("name"=>'Won', 'data'=>[]);;
        foreach($bet_stats as $key=>$row){
            array_push($dates, $row['date_created']);
            array_push($row_data[0]/*['data']*/, (int) $row['bets']);
            array_push($row_data[1]/*['data']*/, (int)$row['paid']);
            array_push($row_data[2]/*['data']*/, (int)$row['lost']);
            array_push($row_data[3]/*['data']*/, (int)$row['won']);
        }
        $data = array("dates"=>$dates, "data"=>$row_data);
        #die(print_r($data, 1));
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $data;

        return $response;
    }

    public function actionBetWinnings(){
        $model = new BetMaster();
        $bet_stats = $model->latestBetWinnings();
        $dates = [];
        $fin_data = [];
        $row_data = []; 
        $row_data[0]= []; //array("name"=>'Bets', 'data'=>[]); 
	//$row_data[1]=[]; // array("name"=>'Paid', 'data'=>[]);; 
	//$row_data[2]= []; //array("name"=>'Lost', 'data'=>[]);; 
	//$row_data[3]= []; //array("name"=>'Won', 'data'=>[]);;
        foreach($bet_stats as $key=>$row){
            array_push($dates, $row['date_created']);
            array_push($row_data[0]/*['data']*/, (float) ($row['win']/1000));
          //  array_push($row_data[1]/*['data']*/, (int)$row['paid']);
          //  array_push($row_data[2]/*['data']*/, (int)$row['lost']);
          //  array_push($row_data[3]/*['data']*/, (int)$row['won']);
        }
        $data = array("dates"=>$dates, "data"=>$row_data);
        #die(print_r($data, 1));
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $data;

        return $response;
    }

    public function actionDeposits(){
        $model = new BetMaster();
        $bet_stats = $model->deposits();
        $dates = [];
        $fin_data = [];
        $row_data = []; 
        $row_data[0]= []; //array("name"=>'Bets', 'data'=>[]); 
	//$row_data[1]=[]; // array("name"=>'Paid', 'data'=>[]);; 
	//$row_data[2]= []; //array("name"=>'Lost', 'data'=>[]);; 
	//$row_data[3]= []; //array("name"=>'Won', 'data'=>[]);;
        foreach($bet_stats as $key=>$row){
            array_push($dates, $row['date_created']);
            array_push($row_data[0]/*['data']*/, (float) ($row['deposit']/1000));
          //  array_push($row_data[1]/*['data']*/, (int)$row['paid']);
          //  array_push($row_data[2]/*['data']*/, (int)$row['lost']);
          //  array_push($row_data[3]/*['data']*/, (int)$row['won']);
        }
        $data = array("dates"=>$dates, "data"=>$row_data);
        #die(print_r($data, 1));
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $data;

        return $response;
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $cmodel = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
                        'cmodel' => $cmodel
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    /*  /site/reset-password?&token=uqL44r9qCW7d9ZeA2hK1Iiia-p40LNam_1502102655 */
    public function actionReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        //print_r($token);die();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('reset-password', [
                    'model' => $model,
        ]);
    }

}
