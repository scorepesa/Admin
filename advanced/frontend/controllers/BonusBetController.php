<?php

namespace frontend\controllers;

use Yii;
use app\models\BonusBet;
use app\models\BonusBetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BonusBetController implements the CRUD actions for BonusBet model.
 */
class BonusBetController extends Controller {

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
     * Lists all BonusBet models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BonusBetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BonusBet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BonusBet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new BonusBet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bonus_bet_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BonusBet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->status == 5 || $model->status == 6) {

                //insert into queue
                $exchange = 'SCOREPESA_WINNER_MESSAGES_QUEUE';
                $queue = 'SCOREPESA_WINNER_MESSAGES_QUEUE';
                //fetch user balance details using bet profile_id
                $win_amount = $model->possible_win;
                //fetch profile details
                $profile_bonus_id = $model->profile_bonus_id;
                $betId = $model->bet_id;
                $profile = \app\models\ProfileBonus::find()
                        ->where('profile_bonus_id = :profile_bonus_id', [':profile_bonus_id' => $profile_bonus_id])
                        ->one();
                $profile_id = $profile->profile_id;
                $profile_obj = \app\models\Profile::find()
                        ->where('profile_id = :profile_id', [':profile_id' => $profile_id])
                        ->one();
                $profile_bal_obj = \app\models\ProfileBalance::find()
                        ->where('profile_id = :profile_id', [':profile_id' => $profile_id])
                        ->one();
                $account_balance = isset($profile_bal_obj->balance) ? $profile_bal_obj->balance : 0;
                $bonus_balance = isset($profile_bal_obj->bonus_balance) ? $profile_bal_obj->bonus_balance : 0;
                //construct message
                if ($model->status == 5) {
                    $message = "Congratulations! you have won Kshs. " . $win_amount . " on Bet ID " . $betId . ". Your Scorepesasports account balance is Kshs. " . $account_balance . ". Your Scorepesasports account bonus balance is Kshs. " . $bonus_balance . ".";
                } else {
                    $message = "Dear punter your bet, Bet ID " . $betId . " was cancelled. Your Scorepesasports account balance is Kshs. " . $account_balance . ". Scorepesasports terms and conditions apply.";
                }
                $model->status = 9;
                $model->save();
                //save outbox
                $outbox_model = new \app\models\Outbox();

                $outbox_data = array("Outbox" => array(
                        "msisdn" => $profile_obj->msisdn,
                        "shortcode" => "719408",
                        "network" => "SAFARICOM",
                        "profile_id" => $profile_id,
                        "linkid" => "6013852000120687",
                        "date_created" => date('Y-m-d H:i:s'),
                        "date_sent" => date('Y-m-d H:i:s'),
                        "retry_status" => 8,
                        "modified" => date('Y-m-d H:i:s'),
                        "text" => $message,
                        "sdp_id" => "6013852000120687"
                ));

                if ($outbox_model->load($outbox_data) && $outbox_model->save()) {
                    $data = array(
                        "refNo" => $profile_obj->msisdn . "_" . $outbox_model->outbox_id,
                        "msisdn" => $profile_obj->msisdn,
                        "message" => $outbox_model->text
                    );
                    $dataArray = array("queue.QMessage" => $data);
                    $message = json_encode($dataArray);

                    Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                    Yii::$app->amqp->declareQueue($queue, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                    Yii::$app->amqp->bindQueueExchanger($queue, $exchange, $routingKey = $queue);
//                    Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);
                }
            }
            Yii::$app->getSession()->setFlash('success', [
                'message' => 'Operation succeded.'
            ]);
            return $this->redirect(['view', 'id' => $model->bet_id]);
        } else {
            //failed
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BonusBet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $refund_amount = $model->bet_amount;
        $profile_bonus_id = $model->profile_bonus_id;
        $profile = \app\models\ProfileBonus::find()
                ->where('profile_bonus_id = :profile_bonus_id', [':profile_bonus_id' => $profile_bonus_id])
                ->one();
        $profile_id = $profile->profile_id;
        $trx_reference = $model->bet_id . "_" . $profile_id;
        $punter_account = $profile_id . "_VIRTUAL";
        $rt_account = "ROAMTECH_VIRTUAL";
        $ratio = $model->ratio;

        $invalid_rst = $model->refund_invalid_bet($refund_amount, $profile_id, $trx_reference, $punter_account, $rt_account, $ratio);

        $msg = 'BetId ' . $model->bet_id . ' cancel failed. If this persists request for help.';
        $error = 'error';
        if (!$invalid_rst):
            $error = 'success';
            $msg = 'BetId ' . $model->bet_id . ' cancel was successful!';
        endif;
        Yii::$app->getSession()->setFlash($error, $msg);
        return $this->redirect(['index']);
    }

    /**
     * Finds the BonusBet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BonusBet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = BonusBet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
