<?php
namespace frontend\controllers;

use Yii;
use app\models\Bet;
use app\models\BetSearch;
use app\models\BetSlip;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * BetController implements the CRUD actions for Bet model.
 */
class BetController extends Controller {

    public function actions() {
        return [
                // ...
                // ...
        ];
    }

    public function action404($id) {
        return $this->render('404');
    }

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
     * Lists all Bet models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all unsettled Bet models.
     * @return mixed
     */
    public function actionUnsettled() {
        $bet_id = array_key_exists('id', \Yii::$app->request->get())
            ? \Yii::$app->request->get()['id']
            : 0;
        $model = \app\models\Bet::find()
               ->where('bet_id = :bid', [':bid'=>$bet_id])
               ->one();
        if ($model) {
             //Get bet_slips and post to queue
            $slips = \app\models\BetSlip::find()
		    ->where('bet_id = :bet_id', [':bet_id' => $model->bet_id])
                    ->andWhere('status = :st', [':st' => 1])
		    ->all();
	    $queue_name = 'SCOREPESA_OUTCOMES_QUEUE';
	    $exchange = 'SCOREPESA_OUTCOMES_QUEUE';
             
            foreach($slips as $slip){
		   $outcomes = \app\models\Outcome::find() 
			->where('parent_match_id = :pmd', [':pmd'=>$slip->parent_match_id])
			->andWhere('sub_type_id = :stid', [':stid'=>$slip->sub_type_id])
			->andWhere('special_bet_value = :sbv', [':sbv'=>$slip->special_bet_value])
			//->andWhere('is_winning_outcome = :iwo', [':iwo'=>1])
			//->andWhere('winning_outcome= :wo', [':wo'=>$slip->bet_pick]);
                 //    die($outcomes->createCommand()->getRawSql());
			->all();
                   $data =  ["parent_match_id"=>$slip->parent_match_id, "live_bet"=>0, "outcomes"=>[]];
		   foreach($outcomes as $outcome){
                      
			$data['outcomes'][] = ["outcomeSaveId"=>"$outcome->match_result_id", 
				   "specialBetValue"=>"$outcome->special_bet_value",
				   "won"=>"$outcome->is_winning_outcome",
				   "outcomeValue"=>"$outcome->winning_outcome",
				   "voidFactor"=>"$outcome->void_factor",
				   "odd_type"=>"$outcome->sub_type_id"];
                   } 
                   if(!empty($data['outcomes'])){
                       $message = json_encode($data);
                       Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);
                       Yii::$app->getSession()->setFlash('success', [
                            'message' => 'Outcome resend success  => ' . $slip->parent_match_id
                     ]);

                   }
                   if(empty($outcomes)){
                       Yii::$app->getSession()->setFlash('error', [
                            'message' => 'Missing outcome for match ID => ' . $slip->parent_match_id
                     ]);
                  }
           } //End for each outcome
           if(empty($slips)){

                Yii::$app->getSession()->setFlash('error', [
                            'message' => 'All slips settled for bet_id ' . $model->bet_id
                     ]);
           }
      }
        

      $searchModel = new BetSearch();
      $dataProvider = $searchModel->unsettled(Yii::$app->request->queryParams);

      return $this->render('unsettled', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
  }


    /**
     * Displays a single Bet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Bet();

        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->bet_id]);
          } else { */
        return $this->render('index', [
                    'model' => $model,
        ]);
//        }
    }

    public function actionBonusAward() {
        $model = new Bet();
        $er = FALSE;
        $error = null;
        if ($model->load(Yii::$app->request->post())) {
            $er = TRUE;
            if ($model->awardEarlyBirdPunters()):
                $msg = 'Operation succeded.';
                $error = 'success';
                $er = FALSE;
            endif;
        }

        if (isset($er) && $er):
            $msg = 'Operation Failed contact Admimistrator.';
            $error = 'error';
        endif;
        if ($error):
            Yii::$app->getSession()->setFlash($error, [
                'message' => $msg
            ]);
        endif;

        return $this->render('bonus-award', [
                    'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        // use Yii's response format to encode output as JSON
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $haystack = array(1, 7);
        if (!in_array($model->status, $haystack)):
            $message = "Action prohibited!. Contact Admin.";
            return ['output' => $model->status, 'message' => $message];
        endif;
        // Check if there is an Editable ajax request
        if (isset(Yii::$app->request->post()['hasEditable'])) {
            $in = Yii::$app->request->post()['editableIndex'];
            $poststatus = Yii::$app->request->post()['Bet'][$in]['status'];
            if ($model->load(Yii::$app->request->post())) {
                $msg = 'Unexpected Request.';

                if ($model->status == 1 && $poststatus == 24) {
                    $msg = "Action Deactivated!.";
                    return ['output' => $model->status, 'message' => $msg];

                    $profile_id = $model->profile_id;
                    $betId = $model->bet_id;

                    $bonusbet_obj = \app\models\BonusBet::find()
                            ->where('bet_id = :bet_id', [':bet_id' => $betId])
                            ->andWhere('profile_bonus_id is not null')
                            ->one();
                    $bet_obj = \app\models\Bet::find()
                            ->where('bet_id = :bet_id', [':bet_id' => $betId])
                            ->one();
                    $bonus_bet_amount = isset($bonusbet_obj->bet_amount) ? $bonusbet_obj->bet_amount : 0;
                    $bet_amount = isset($bet_obj->bet_amount) && isset($bonusbet_obj->ratio) ? ($bet_obj->bet_amount * $bonusbet_obj->ratio) : $bet_obj->bet_amount;

                    $result = $model->refund_invalid_bet($bet_amount, $bonus_bet_amount, $profile_id);

                    if ($result):
                        $msg = 'Operation succeded. Bet cancelled.';
                    else:
                        $msg = 'Operation failed!. Ensure cancel is within 30 minutess after place.';
                    endif;
                } elseif ($model->status == 7 && $poststatus == 2) {
                    $slip = \app\models\BetSlip::find()
                            ->where('bet_id = :bet_id', [':bet_id' => $model->bet_id])
                            ->one();
                    $model->updateBetStatus($poststatus);
                    
                    $queue_name = 'SCOREPESA_OUTCOMES_QUEUE';
                    $exchange = 'SCOREPESA_OUTCOMES_QUEUE';

                    $outcome = \app\models\Outcome::find() 
                        ->where('parent_match_id = :pmd', [':pmd'=>$slip->parent_match_id])
                        ->andWhere('sub_type_id = :stid', [':stid'=>$slip->sub_type_id])
                        ->andWhere('special_bet_value = :sbv', [':sbv'=>$slip->special_bet_value])
                        ->andWhere('is_winning_outcome = :iwo', [':iwo'=>1])
                        ->andWhere('winning_outcome= :wo', [':wo'=>$slip->bet_pick])
                       //die($outcome->createCommand()->getRawSql());
                        ->one();
                    if(!is_null($outcome)){
                        $data = ["parent_match_id"=>"$slip->parent_match_id",
                            "outcomes"=>[
                                   ["outcomeSaveId"=>"$outcome->match_result_id", 
                                   "specialBetValue"=>"$outcome->special_bet_value",
                                   "won"=>"1",
                                   "outcomeValue"=>"$outcome->winning_outcome",
                                   "voidFactor"=>"0.0",
                                   "odd_type"=>"$outcome->sub_type_id"]
                             ],
                             "live_bet"=>0];
                        $message = json_encode($data);
                        Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);
                    }
                    $msg = 'Operation succeded. Confirm bet settled';
                }
                // return JSON encoded output in the below format
                return ['output' => $model->status, 'message' => $msg];
            }
            // else if nothing to do always return an empty JSON encoded output
        } else {
            return ['output' => '', 'message' => ''];
        }
    }

    /**
     * Updates an existing Bet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateOld($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->status == 5 || $model->status == 6 || $model->status == 9) {

//insert into queue
                $exchange = 'SCOREPESA_WINNER_MESSAGES_QUEUE';
                $queue = 'SCOREPESA_WINNER_MESSAGES_QUEUE';
//fetch user balance details using bet profile_id
                $win_amount = $model->possible_win;
//fetch profile details
                $profile_id = $model->profile_id;
                $betId = $model->bet_id;
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
                    $message = "Congratulations! you have won Kshs. " . $win_amount . " on Bet ID " . $betId . ". Your scorepesa account balance is Kshs. " . $account_balance . ". Your scorepesa account bonus balance is Kshs. " . $bonus_balance . ".";
                } else {
                    $message = "Your bet, Bet ID " . $betId . " was cancelled. Your scorepesa account balance is Kshs. " . $account_balance . ". Scorepesa terms and conditions apply.";
                }
                $model->status = 24;
                $model->save();
//save outbox
                $outbox_model = new \app\models\Outbox();

                $outbox_data = array("Outbox" => array(
                        "msisdn" => $profile_obj->msisdn,
                        "shortcode" => "6276226",
                        "network" => "SAFARICOM",
                        "profile_id" => $profile_id,
                        "linkid" => "8868782802",
                        "date_created" => date('Y-m-d H:i:s'),
                        "date_sent" => date('Y-m-d H:i:s'),
                        "retry_status" => 8,
                        "modified" => date('Y-m-d H:i:s'),
                        "text" => $message,
                        "sdp_id" => "8972892"
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
                    Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue, $content_type = 'applications/json', $app_id = Yii::$app->name);
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
     * Deletes an existing Bet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $refund_amount = $model->bet_amount;
        $profile_id = $model->profile_id;
        $trx_reference = $model->bet_id . "_" . $model->profile_id;
        $punter_account = $profile_id . "_VIRTUAL";
        $rt_account = "ROAMTECH_VIRTUAL";

        /* $invalid_rst = $model->refund_invalid_bet($refund_amount, $profile_id, $trx_reference, $punter_account, $rt_account);

          $msg = 'BetId ' . $model->bet_id . ' cancel failed. If this persists request for help.';
          $error = 'error';
          if (!$invalid_rst):
          $error = 'success';
          $msg = 'BetId ' . $model->bet_id . ' cancel was successful!';
          endif;
         */
        $error = 'error';
        $msg = "Not allowed!";
        Yii::$app->getSession()->setFlash($error, $msg);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Bet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRevertTransactions() {
        $profile_obj = \app\models\Profile::find()
                ->where('profile_id = :profile_id', [':profile_id' => $profile_id])
                ->one();
    }

    public function actionSlipdetail() {
        if (isset($_POST['expandRowKey'])) {
            $searchModel = new BetSlip();
            $query = $searchModel->find()->where(["bet_id" => $_POST['expandRowKey']]);

            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->renderPartial('_expand_slip_detail', ['model' => $searchModel,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider]);
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }

}
