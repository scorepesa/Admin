<?php

namespace frontend\controllers;

use Yii;
use app\models\Outcome;
use app\models\OutcomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\Match;
use app\models\oddType;
use app\models\BetSlip;
use app\models\Bet;
use app\models\MatchSearch;

/**
 * OutcomeController implements the CRUD actions for Outcome model.
 */
class OutcomeController extends Controller {

    const log = "OUTCOME";
    const log_cat = "";

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


    public function actionDrawnobet() {

        $model = new Outcome();

        if ($model->load(Yii::$app->request->post())) {
            
            // get parent match id from form
            $parent_match_id = $model->parent_match_id;
            $market = $model->sub_type_id;
            $odd_key = $model->odd_key;
  
            $result = $model->resultDrawnobet($parent_match_id, $market, $odd_key);

            if($result) {

                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Parent Match Id  : '.$parent_match_id.' successfully resulted'
                ]);

            } else {
                Yii::$app->getSession()->setFlash('error', [
                'message' => 'Error in resulting Parent Match Id is : '.$parent_match_id
                ]);
            }

            
            return $this->render('drawnobet', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('drawnobet', [
                        'model' => $model,
            ]);
        }
    }


    public function actionSingleresulting() {
        $_get = Yii::$app->request->get();

        if (isset($_get) && isset($_get['sub_type_id']) && isset($_get['parent_match_id'])) {
            $bet_slip_id = isset($_get['BetSlipSearch[bet_slip_id]']) ? $_get['BetSlipSearch[bet_slip_id]'] : '';

            //die(var_dump($_get));
            $model = new Outcome();
            $model->parent_match_id = $_get['parent_match_id'];
            $model->sub_type_id = $_get['sub_type_id'];
            $model->special_bet_value = $_get['special_bet_value'];
            $model->status = 0;
            $model->created_by = Yii::$app->user->identity->username;
            $model->created = date('Y-m-d H:i:s');
            $model->winning_outcome = $_get['winning_outcome'];
	    $model->void_factor = 0;
            $rows = (new \yii\db\Query())
                            ->select(['match_result_id'])
                            ->from('outcome')
                            ->where(['parent_match_id' => $model->parent_match_id,
                                'sub_type_id' => $model->sub_type_id,
                                'winning_outcome' => $model->winning_outcome])->all();

            if (count($rows) < 1) {
                if ($model->save()) {
                    //await approval
                    Yii::$app->getSession()->setFlash('warning', [
                        'message' => 'Outcome created pending approval please notify the authorised.'
                    ]);
                }
                return $this->redirect(['index', 'BetSlipSearch[bet_slip_id]' => $bet_slip_id]);
            }
        }
        $searchModel = new \app\models\BetSlipSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('//bet-slip/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCustresulting() {
        $model = new \app\models\BetSlip();

        $model->load(Yii::$app->request->post());
        if (Yii::$app->request->post()) {

            $indeex = Yii::$app->request->post()['editableIndex'];

            if (!empty($model->sub_type_id) && !empty($model->cust_result)):
                $woutcome = $model->cust_result;

                $sub_type = $model->sub_type_id;

                $htftsc = explode("-", Yii::$app->request->post()['BetSlip'][$indeex]['htFtScore']);

                $ht_sc = isset($htftsc[0]) ? $htftsc[0] : "";
                $ft_sc = isset($htftsc[1]) ? $htftsc[1] : "";

                $output = "";
                $sport_data = $model->match_sport($model->parent_match_id);

                $sport_id = isset($sport_data['sport_id']) ? $sport_data['sport_id'] : "";

                if ((int) $model->sub_type_id == 0) {
                    //anytime goal scorers marketing resulting
                    $this->pushToQueueAnytimeGoalScorer($model->parent_match_id, $model->anytime_goal_scorers, $model->cust_result);
                } elseif ((int) $model->sub_type_id == 139 || (int) $model->sub_type_id == 162) {
                    //total bookings and total conners
                    $valid_sps = \app\models\EventOdd::find()
                            ->where(['=', 'parent_match_id', $model->parent_match_id])
                            ->andWhere(['=', 'sub_type_id', $model->sub_type_id])
                            ->all();
                    foreach ($valid_sps as $sps) {
                        $winning_outcome = $this->getBookingConnerWoutcome($sps->sub_type_id, $model->cust_result, $sps->special_bet_value);
                        $this->saveOutcomeToDb($model, $sps, $winning_outcome, $ht_sc = '', $ft_sc = '', TRUE);
                    }
                } elseif (!empty($ft_sc) && !empty($ht_sc) && !empty($model->parent_match_id) && $sport_id == 79) {
                    $output = $ht_sc . " - " . $ft_sc;
                    if (is_array($woutcome) && count($woutcome) > 0):
                        foreach ($woutcome as $c_outcome) {
                            $this->saveOutcomeToDb($model, $sub_type, $c_outcome, $ht_sc, $ft_sc, TRUE);
                        }
                    else:
                        $this->saveOutcomeToDb($model, $sub_type, $woutcome, $ht_sc, $ft_sc, TRUE);
                    endif;
                    $message = 'Operation succeded. Outcome created kindly go to approval page to approve it for processing.';
                } else {
                    //other sports single market resulting
                    if (!empty($model->parent_match_id)):
                        if (is_array($woutcome) && count($woutcome) > 0):
                            foreach ($woutcome as $c_outcome) {
                                $message = 'Operation succeded. Outcome created kindly go to approval page to approve it for processing.';
                                $this->saveOutcomeToDb($model, $sub_type, $c_outcome, $ht_sc = '', $ft_sc = '', TRUE);
                            }
                        else:
                            $message = 'Operation succeded. Outcome created kindly go to approval page to approve it for processing.';
                            $this->saveOutcomeToDb($model, $sub_type, $woutcome, $ht_sc = '', $ft_sc = '', TRUE);
                        endif;
                    else:
                        $message = 'Operation failed. No match matching the outcome or contact Administrator for assistance.';
                    endif;
                }
            else:
                //HT/FT results calculation
                $halftime_score = $model->halftime_score;
                $fulltime_score = $model->fulltime_score;
                $output = $halftime_score . " - " . $fulltime_score;
                $sport_data = $model->match_sport($model->parent_match_id);

                $sport_id = isset($sport_data['sport_id']) ? $sport_data['sport_id'] : "";

                if ($model->parent_match_id != null && $sport_id == 79) {

                    $valid_sub_types = \app\models\EventOdd::find()->where(['=', 'parent_match_id', $model->parent_match_id])->all();

                    $ft_score = explode(":", $fulltime_score);
                    $ht_score = explode(":", $halftime_score);

                    if (sizeof($ft_score) !== 2 || sizeof($ht_score) !== 2) {
                        $message = 'Provided wrong format of scores. Format is x:y.';
                        echo json_encode(array("output" => 'Error', "message" => $message));
                    }

                    if (($ht_score[0] > $ft_score[0]) || ($ht_score[1] > $ft_score[1])) {
                        $message = 'Halftime scores greater than fulltime scores not allowed.';
                        echo json_encode(array("output" => 'Error', "message" => $message));
                    }

                    foreach ($valid_sub_types as $valid_sub_type) {

                        $winning_outcome = $this->getSoccerWinningOutcome($valid_sub_type->sub_type_id, $ht_score, $ft_score, $valid_sub_type->odd_key, $valid_sub_type->special_bet_value);

                        if ($winning_outcome == null) {
                            continue;
                        }
                        if (is_array($winning_outcome)) {
                            foreach ($winning_outcome as $key => $outcome) {
                                $this->saveOutcomeToDb($model, $valid_sub_type, $outcome, $halftime_score, $fulltime_score, FALSE);
                            }
                        } else {
                            $this->saveOutcomeToDb($model, $valid_sub_type, $winning_outcome, $halftime_score, $fulltime_score, FALSE);
                        }
                    }
                    $message = 'Operation succeded. Outcome created kindly go to approval page to approve it for processing.';
                }
            endif;
        }

        echo json_encode(array("output" => $output, "message" => isset($message) ? $message : ""));
    }

    public function action2wayResulting() {
        $model = new \app\models\BetSlip();

        $model->load(Yii::$app->request->post());
        if (Yii::$app->request->post()) {

            $indeex = Yii::$app->request->post()['editableIndex'];

            if (!empty($model->sub_type_id) && !empty($model->cust_result)):
                $woutcome = $model->cust_result;

                $sub_type = $model->sub_type_id;

                $htftsc = explode("-", Yii::$app->request->post()['BetSlip'][$indeex]['htFtScore']);

                $ht_sc = isset($htftsc[0]) ? $htftsc[0] : "";
                $ft_sc = isset($htftsc[1]) ? $htftsc[1] : "";

                $output = "";
                $sport_data = $model->match_sport($model->parent_match_id);

                $sport_id = isset($sport_data['sport_id']) ? $sport_data['sport_id'] : "";

                if ($model->sub_type_id == 235) {
                    //anytime goal scorers marketing resulting
                    $this->pushToQueueAnytimeGoalScorer($model->parent_match_id, $model->anytime_goal_scorers, $model->cust_result);
                } elseif ($model->sub_type_id == 236 || $model->sub_type_id == 272) {
                    //total bookings and total conners
                    $valid_sps = \app\models\EventOdd::find()
                            ->where(['=', 'parent_match_id', $model->parent_match_id])
                            ->andWhere(['=', 'sub_type_id', $model->sub_type_id])
                            ->all();
                    foreach ($valid_sps as $sps) {
                        $winning_outcome = $this->getBookingConnerWoutcome($sps->sub_type_id, $model->cust_result, $sps->special_bet_value);
                        $this->saveOutcomeToDb($model, $model->sub_type_id, $winning_outcome, $ht_sc = '', $ft_sc = '', TRUE);
                    }
                } elseif (!empty($ft_sc) && !empty($ht_sc) && !empty($model->parent_match_id) && $sport_id == 14) {
                    $output = $ht_sc . " - " . $ft_sc;
                    if (is_array($woutcome) && count($woutcome) > 0):
                        foreach ($woutcome as $c_outcome) {
                            $this->saveOutcomeToDb($model, $sub_type, $c_outcome, $ht_sc, $ft_sc, TRUE);
                        }
                    else:
                        $this->saveOutcomeToDb($model, $sub_type, $woutcome, $ht_sc, $ft_sc, TRUE);
                    endif;
                    $message = 'Operation succeded. Outcome created kindly go to approval page to approve it for processing.';
                } else {
                    //other sports single market resulting
                    if (!empty($model->parent_match_id)):
                        if (is_array($woutcome) && count($woutcome) > 0):
                            foreach ($woutcome as $c_outcome) {
                                $message = 'Operation succeded. Outcome created kindly go to approval page to approve it for processing.';
                                $this->saveOutcomeToDb($model, $sub_type, $c_outcome, $ht_sc = '', $ft_sc = '', TRUE);
                            }
                        else:
                            $message = 'Operation succeded. Outcome created kindly go to approval page to approve it for processing.';
                            $this->saveOutcomeToDb($model, $sub_type, $woutcome, $ht_sc = '', $ft_sc = '', TRUE);
                        endif;
                    else:
                        $message = 'Operation failed. No match matching the outcome or contact Administrator for assistance.';
                    endif;
                }
            else:
                //HT/FT results calculation
                $halftime_score = $model->halftime_score;
                $fulltime_score = $model->fulltime_score;
                $output = $halftime_score . " - " . $fulltime_score;
                $sport_data = $model->match_sport($model->parent_match_id);

                $sport_id = isset($sport_data['sport_id']) ? $sport_data['sport_id'] : "";

                if ($model->parent_match_id != null && $sport_id == 14) {

                    $valid_sub_types = \app\models\EventOdd::find()->where(['=', 'parent_match_id', $model->parent_match_id])->all();

                    $ft_score = explode(":", $fulltime_score);
                    $ht_score = explode(":", $halftime_score);

                    if (sizeof($ft_score) != 2 || sizeof($ht_score) != 2) {
                        $message = 'Provided wrong format of scores. Format is x:y.';
                        echo json_encode(array("output" => 'Error', "message" => $message));
                    }

                    if (($ht_score[0] > $ft_score[0]) || ($ht_score[1] > $ft_score[1])) {
                        $message = 'Halftime scores greater than fulltime scores not allowed.';
                        echo json_encode(array("output" => 'Error', "message" => $message));
                    }

                    foreach ($valid_sub_types as $valid_sub_type) {

                        $winning_outcome = $this->getSoccerWinningOutcome($valid_sub_type->sub_type_id, $ht_score, $ft_score, $valid_sub_type->odd_key, $valid_sub_type->special_bet_value);

                        if ($winning_outcome == null) {
                            continue;
                        }
                        if (is_array($winning_outcome)) {
                            foreach ($winning_outcome as $key => $outcome) {
                                $this->saveOutcomeToDb($model, $valid_sub_type, $outcome, $halftime_score, $fulltime_score, FALSE);
                            }
                        } else {
                            $this->saveOutcomeToDb($model, $valid_sub_type, $winning_outcome, $halftime_score, $fulltime_score, FALSE);
                        }
                    }
                    $message = 'Operation succeded. Outcome created kindly go to approval page to approve it for processing.';
                }
            endif;
        }

        echo json_encode(array("output" => $output, "message" => isset($message) ? $message : ""));
    }

    public function actionResulting() {
        $_get = Yii::$app->request->get();
        $_outcome = new Outcome();
        $otcsearch = new OutcomeSearch();
        $model = new BetSlip();
        $dropdwnmodel = new \app\models\DropDownActionColumn();
        $model->load(Yii::$app->request->post());

        $searchModel = new MatchSearch();
        $dataProvider = $searchModel->searchResulting(Yii::$app->request->queryParams);
        $otcdataProvider = $otcsearch->search(Yii::$app->request->queryParams);

        return $this->render('resulting', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'outcome' => $_outcome,
                    'otcdataProvider' => $otcdataProvider,
                    'dropdwn' => $dropdwnmodel,
                    'bsmodel' => $model
        ]);
    }

    public function actionApproveoutcome() {
        $_betslip = new Match();
        $model = new Outcome();

        if (Yii::$app->request->post() && Yii::$app->request->post()['MatchMaster']['parent_match_id']) {
            $pmid = Yii::$app->request->post()['MatchMaster']['parent_match_id'];
            if ($this->pushToQueue($pmid)):
                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Operation succeded, outcome has been approved and processed.'
                ]);
            else:
                Yii::$app->getSession()->setFlash('error', [
                    'message' => 'Operation failed please try again. If this persists contact Technical Dpt.'
                ]);
            endif;
        }
        $searchModel = new MatchSearch();
        $dataProvider = $searchModel->resultApproval(Yii::$app->request->queryParams);
        return $this->render('result_approval', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'outcome' => $model,
                    'model' => $_betslip
        ]);
    }

    public function saveOutcomeToDb($model, $valid_sub_type, $winnging_outcome, $ht, $ft, $score_exist = FALSE) {
        /*        $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction(); */

        $omodel = new Outcome();
        $match_model = new Match();
        $omodel->parent_match_id = $model->parent_match_id;
        $omodel->sub_type_id = isset($valid_sub_type->sub_type_id) ? $valid_sub_type->sub_type_id : $valid_sub_type;
        $omodel->special_bet_value = isset($valid_sub_type->special_bet_value) ? $valid_sub_type->special_bet_value : "";
        $omodel->status = 0;
        $omodel->created_by = Yii::$app->user->identity->username;
        $omodel->created = date('Y-m-d H:i:s');
        $omodel->winning_outcome = (string) $winnging_outcome;
        $omodel->approved_status = 0;

        /*
         * check if outcome exists to avoid duplicate
         */
        $outcome = (new \yii\db\Query())
                ->select(['match_result_id', 'sub_type_id', 'winning_outcome'])
                ->from('outcome')
                ->where(['parent_match_id' => $model->parent_match_id,
                    'sub_type_id' => isset($valid_sub_type->sub_type_id) ? $valid_sub_type->sub_type_id : $valid_sub_type,
                    'special_bet_value' => isset($valid_sub_type->special_bet_value) ? $valid_sub_type->special_bet_value : "",
                    'approved_status' => 0])
                ->andWhere(['not in', 'created_by', ['BETRADAR-LIVE', 'BETRADAR']])
                ->one();
//        echo $outcome->createCommand()->getRawSql();
//        print_r($outcome);die();
        if (!empty($outcome)):
        //remove existing outcome before creating new
        //$sql = "DELETE FROM outcome WHERE parent_match_id = $model->parent_match_id AND sub_type_id= $valid_sub_type->sub_type_id AND special_bet_value='$valid_sub_type->special_bet_value'";
//            echo $sql;
//            $res = \Yii::$app->db->createCommand($sql)->execute();
//            print_r($res);
        endif;

        $match = $match_model->find()
                ->where(['parent_match_id' => $model->parent_match_id])
                ->one();
        if (!$score_exist):
            $match->ht_score = $ht;
            $match->ft_score = $ft;
            $match->update();
        endif;

        $rows = (new \yii\db\Query())
                ->select(['match_result_id'])
                ->from('outcome')
                ->where(['parent_match_id' => $model->parent_match_id,
                    'sub_type_id' => isset($valid_sub_type->sub_type_id) ? $valid_sub_type->sub_type_id : $valid_sub_type,
                    'winning_outcome' => $winnging_outcome,
                    'special_bet_value' => isset($valid_sub_type->special_bet_value) ? $valid_sub_type->special_bet_value : ""])
                ->one();

        if (empty($rows)) {

            try {
                if ($omodel->save()) {
                    //$transaction->commit();
                    Yii::info("Saved outcome successfully ::" . json_encode($winnging_outcome), $category = 'application');
                    return true;
                } else {
                    //  $transaction->rollBack();
                    Yii::error("ERROR saving to db Post Outcome to Queue ::" . json_encode($omodel));
                    return false;
                }
            } catch (Exception $exc) {
                //$transaction->rollBack();
                Yii::error("EXCEPTION saving to db Posting Outcome to Queue ::" . $exc->getMessage());
                return false;
            }
        }
    }

    public function pushToQueueAnytimeGoalScorer($parent_match_id, $goalscorers, $winningoutcome) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $queue_name = 'SCOREPESA_OUTCOMES_QUEUE';
            $exchange = 'SCOREPESA_OUTCOMES_QUEUE';

            $i = 0;

            $_outcome = array();
            //winning outcome
            foreach ($winningoutcome as $outcome) {
                $omodel = new Outcome();
                $omodel->parent_match_id = $parent_match_id;
                $omodel->sub_type_id = 235;
                $omodel->special_bet_value = "";
                $omodel->status = 0;
                $omodel->created_by = Yii::$app->user->identity->username;
                $omodel->created = date('Y-m-d H:i:s');
                $omodel->winning_outcome = (string) $outcome;
                $omodel->approved_status = 0;

                $omodel->save();

                $_data = array(
                    "outcomeSaveId" => $omodel->match_result_id,
                    "outcomeValue" => (string) $outcome,
                    "odd_type" => 235
                );
                array_push($_outcome, $_data);
            }
            //void not play
            foreach ($goalscorers as $scorer) {
                $omodel = new Outcome();
                $omodel->parent_match_id = $parent_match_id;
                $omodel->sub_type_id = 235;
                $omodel->special_bet_value = "";
                $omodel->status = 0;
                $omodel->created_by = Yii::$app->user->identity->username;
                $omodel->created = date('Y-m-d H:i:s');
                $omodel->winning_outcome = (string) $scorer;
                $omodel->approved_status = 0;

                $omodel->save();

                $_data = array(
                    "outcomeSaveId" => $omodel->match_result_id,
                    "outcomeValue" => (string) $scorer,
                    "voidFactor" => 1,
                    "odd_type" => 235
                );
                array_push($_outcome, $_data);
            }

            $data = array(
                "parent_match_id" => $parent_match_id,
                "live_bet" => 0,
                "outcomes" => $_outcome
            );
            $i++;

            $message = json_encode($data);

            try {
                Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);
                $transaction->commit();
            } catch (Exception $exc) {
                $transaction->rollBack();
                Yii::error("EXCEPTION MQ CONNECTION ::" . $exc->getMessage());
            }
        } catch (Exception $exc) {
            $transaction->rollBack();
            Yii::error("EXCEPTION Posting anytimegoalscorer Outcome to Queue ::" . $exc->getMessage());
            return FALSE;
        }
    }

    public function pushToQueue($parent_match_id) {
        try {
            $queue_name = 'SCOREPESA_OUTCOMES_QUEUE';
            $exchange = 'SCOREPESA_OUTCOMES_QUEUE';
            $model = new Outcome();
            $model->parent_match_id = $parent_match_id;

            $i = 0;

            $_outcome = array();
            $outcome_data = $model->findAll(['parent_match_id' => $model->parent_match_id]);
            if (count($outcome_data) == 0):
                return FALSE;
            endif;
            foreach ($outcome_data as $db_outcome) {

                if ((int) $db_outcome->sub_type_id == 47 && (string) $db_outcome->winning_outcome == "X") {
                    for ($a = 1; $a <= 2; $a++) {
                        $_data = array(
                            "outcomeSaveId" => $db_outcome->match_result_id,
                            "outcomeKey" => (string) $i,
                            "outcomeValue" => (string) $a,
                            "voidFactor" => 1,
                            "odd_type" => $db_outcome->sub_type_id
                        );
                        array_push($_outcome, $_data);

                        //update outcome to void factor
                        $db_outcome->winning_outcome = $a;
                        $db_outcome->save();
                        
                    }
                } else {
                    $_data = array(
                        "outcomeSaveId" => $db_outcome->match_result_id,
                        "outcomeKey" => (string) $i,
                        "outcomeValue" => (string) $db_outcome->winning_outcome,
                        "odd_type" => $db_outcome->sub_type_id
                    );
                    if (!empty($db_outcome->special_bet_value)):
                        $_data["specialBetValue"] = $db_outcome->special_bet_value;
                    endif;
                    array_push($_outcome, $_data);
                }

                $i++;
            }
//flag outcome as approved per subtype

            $approved = $model->updateOutcomeApproval(Yii::$app->user->identity->username, $db_outcome->sub_type_id, $model->parent_match_id);

            if ($approved):
                $data = array(
                    "parent_match_id" => $model->parent_match_id,
                    "live_bet" => !empty($model->live_bet) ? $model->live_bet : 0,
                    "outcomes" => $_outcome
                );
                $i++;

                $message = json_encode($data);

                try {
                    Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                    Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                    Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
                    Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);

                    Yii::info("Approved Outcome pushed to queue::" . $message);
                } catch (Exception $exc) {
                    Yii::error("EXCEPTION MQ CONNECTION ::" . $exc->getMessage());
                }
                return TRUE;
            else:
                return FALSE;
            endif;
        } catch (Exception $exc) {
            Yii::error("EXCEPTION Posting approved Outcome to Queue ::" . $exc->getMessage());
            return FALSE;
        }
    }

    /**
     * Lists all Outcome models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new OutcomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Outcome model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Outcome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Outcome();
        try {
            $queue_name = 'SCOREPESA_OUTCOMES_QUEUE';
            $exchange = 'SCOREPESA_OUTCOMES_QUEUE';
            $_outcome = array();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $_data = array(
                    "outcomeSaveId" => $model->match_result_id,
                    "outcomeKey" => (string) 1,
                    "outcomeValue" => (string) $model->winning_outcome,
                    "odd_type" => $model->sub_type_id
                );
                if (!empty($model->special_bet_value)):
                    $_data["specialBetValue"] = $model->special_bet_value;
                endif;
                array_push($_outcome, $_data);
                $data = array(
                    "parent_match_id" => $model->parent_match_id,
                    "live_bet" => !empty($model->live_bet) ? $model->live_bet : 0,
                    "outcomes" => $_outcome
                );

                $message = json_encode($data);

                #Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                #Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                #Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);

                return $this->redirect(['view', 'id' => $model->match_result_id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } catch (yii\db\IntegrityException $exc) {
            Yii::error("EXCEPTION create outcome ::" . $exc->getMessage());
            Yii::$app->getSession()->setFlash('error', [
                'message' => 'Operation failed, outcome could not be created. Please try again later or contact Tech.' .$exc->getMessage()
            ]);
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }


    public function actionCreateLive() {
        $model = new Outcome();
        try {
            $model->live_bet=1;
            $queue_name = 'SCOREPESA_OUTCOMES_QUEUE';
            $exchange = 'SCOREPESA_OUTCOMES_QUEUE';
            $_outcome = array();

            if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
                $_data = array(
                    "outcomeSaveId" => $model->match_result_id,
                    "outcomeKey" => (string) 1,
                    "outcomeValue" => (string) $model->winning_outcome,
                    "odd_type" => $model->sub_type_id
                );
                if (!empty($model->special_bet_value)):
                    $_data["specialBetValue"] = $model->special_bet_value;
                endif;
                array_push($_outcome, $_data);
                $data = array(
                    "parent_match_id" => $model->parent_match_id,
                    "live_bet" => !empty($model->live_bet) ? $model->live_bet : 0,
                    "outcomes" => $_outcome
                );

                $message = json_encode($data);

                #Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                #Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                #Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);

                return $this->redirect(['view', 'id' => $model->match_result_id]);
            } else {
                return $this->render('create-live', [
                            'model' => $model,
                ]);
            }
        } catch (yii\db\IntegrityException $exc) {
            Yii::error("EXCEPTION create outcome ::" . $exc->getMessage());
            Yii::$app->getSession()->setFlash('error', [
                'message' => 'Operation failed, outcome could not be created. Please try again later or contact Tech.'
            ]);
            return $this->render('create-live', [
                        'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Outcome model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        try {
            $queue_name = 'SCOREPESA_OUTCOMES_QUEUE';
            $exchange = 'SCOREPESA_OUTCOMES_QUEUE';
            $_outcome = array();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $_data = array(
                    "outcomeSaveId" => $model->match_result_id,
                    "outcomeKey" => (string) 1,
                    "outcomeValue" => (string) $model->winning_outcome,
                    "odd_type" => $model->sub_type_id
                );
                if (!empty($model->special_bet_value)):
                    $_data["specialBetValue"] = $model->special_bet_value;
                endif;
                array_push($_outcome, $_data);
                $data = array(
                    "parent_match_id" => $model->parent_match_id,
                    "live_bet" => !empty($model->live_bet) ? $model->live_bet : 0,
                    "outcomes" => $_outcome
                );

                $message = json_encode($data);

                #Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                #Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                #Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);

                return $this->redirect(['view', 'id' => $model->match_result_id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } catch (yii\db\IntegrityException $exc) {
            Yii::error("EXCEPTION update outcome ::" . $exc->getMessage());
            Yii::$app->getSession()->setFlash('error', [
                'message' => 'Operation failed, outcome could not be updated. Please try again later or contact Tech.'
            ]);
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionBulkupdatemisingoutcome() {
        $model = new Outcome();

        $queue_name = 'SCOREPESA_OUTCOMES_QUEUE';
        $exchange = 'SCOREPESA_OUTCOMES_QUEUE';
        $_outcome = array();
        $data = $model->fetch_jumped_outcome();
        foreach ($data as $row) {
            if (!empty($row['winning_outcome'])) {

                $_data = array(
                    "outcomeSaveId" => $row['match_result_id'],
                    "outcomeKey" => (string) 1,
                    "outcomeValue" => (string) $row['winning_outcome'],
                    "odd_type" => $row['sub_type_id']
                );
                if (!empty($row['special_bet_value'])):
                    $_data["specialBetValue"] = $row['special_bet_value'];
                endif;
                array_push($_outcome, $_data);
                $data = array(
                    "parent_match_id" => $row['parent_match_id'],
                    "live_bet" => !empty($row['live_bet']) ? $row['live_bet'] : 0,
                    "outcomes" => $_outcome
                );

                $message = json_encode($data);

                #Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                #Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                #Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);
            } else {
                echo 'Oops! ERROR OCCURED ::: ' . json_encode($data);
                continue;
            }
        }
    }

    /**
     * Deletes an existing Outcome model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Outcome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Outcome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Outcome::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 
     * @param type $sub_type_id
     * @param type $ht_score
     * @param type $ft_score
     * @param type $odd_key
     * @param type $special_bet_value
     * @return boolean
     */
    public function getSoccerWinningOutcome($sub_type_id, $ht_score, $ft_score, $odd_key, $special_bet_value = null) {
        Yii::info("::get winning outcome ::$sub_type_id, $ht_score[0], $ft_score[0], $special_bet_value", self::log);
        switch ($sub_type_id) {
            case 1:
                $result = (($ft_score[0] > $ft_score[1]) ? 1 : (($ft_score[0] == $ft_score[1]) ? 'X' : 2));
                break;
            case 2:
                $result = $ft_score[0] . ':' . $ft_score[1];
                break;
            case 1:
                $sp_values = explode(":", $special_bet_value);
                if (count($sp_values) == 2) {
                    $win_result = [$ft_score[0] + $sp_values[0], $ft_score[1] + $sp_values[1]];
                    $result = ($win_result[0] > $win_result[1]) ? 1 : (($win_result[0] == $win_result[1]) ? 'X' : 2);
                } else {
                    return false;
                }
                break;
            case 332:
                $result = $ft_score[0] . ':' . $ft_score[1];
                break;
            case 42:
                $result = ($ht_score[0] > $ht_score[1]) ? 1 : (($ht_score[0] == $ht_score[1]) ? 'X' : 2);
                break;
            case 49:
                $result = $ft_score[1];
                break;
            case 203:
                $result = $ht_score[0] . ':' . $ht_score[1];
                break;
            case 60:
                $scored = $ft_score[0] + $ft_score[1];
                $result = $scored > $special_bet_value ? 'Over' : 'Under';
                break;
            case 207:
                $gaols_ht = $ht_score[0] + $ht_score[1];
                $goals_2nd = ($ft_score[0] + $ft_score[1]) - $gaols_ht;
                $result = ($gaols_ht > $goals_2nd) ? '1st' : (($gaols_ht == $goals_2nd) ? 'Equal' : '2nd');
                break;
            case 202:
                $tot = $ft_score[0] + $ft_score[1];
                if ($tot < 2) {
                    $result = '0-1 goals';
                } else if ($tot > 1 && $tot < 4) {
                    $result = '2-3 goals';
                } else if ($tot > 3 && $tot < 6) {
                    $result = '4-5 goals';
                } else {
                    $result = '6+';
                }
                break;
            case 578:
                $resultS = '';
                $tot = $ft_score[1];
                if ($tot < 1) {
                    $resultS[] = '0';
                }
                if ($tot > 0 && $tot < 3) {
                    $resultS[] = '1-2';
                }
                if ($tot > 0 && $tot < 4) {
                    $resultS[] = '1-3';
                }
                if ($tot > 2 && $tot < 4) {
                    $resultS[] = '2-3';
                }
                if ($tot > 3) {
                    $resultS[] = '4+';
                }
                $result = $resultS;
                break;
            case 577:
                $resultS = '';
                $tot = $ft_score[0];
                if ($tot < 1) {
                    $resultS[] = '0';
                }
                if ($tot > 0 && $tot < 3) {
                    $resultS[] = '1-2';
                }
                if ($tot > 0 && $tot < 4) {
                    $resultS[] = '1-3';
                }
                if ($tot > 2 && $tot < 4) {
                    $resultS[] = '2-3';
                }
                if ($tot > 3) {
                    $resultS[] = '4+';
                }
                $result = $resultS;
                break;
            case 570:
                $ress = '';
                $dc_results = $ft_score[0] > $ft_score[1] ? ['HomeDraw', 'HomeAway'] : (($ft_score[0] == $ft_score[1]) ? ['HomeDraw', 'DrawAway'] : ['DrawAway', 'HomeAway']);
                $gg_result = ($ft_score[0] > 0 && $ft_score[1] > 0) ? 'Yes' : 'No';
                foreach ($dc_results as $dc_result) {
                    $ress[] = $dc_result . ' / ' . $gg_result;
                }
                $result = $ress;
                break;
            case 575:
                $resultS = '';
                $tot = $ht_score[0] + $ht_score[1];
                if ($tot < 1) {
                    $resultS[] = '0';
                }
                if ($tot > 0 && $tot < 3) {
                    $resultS[] = '1-2';
                }
                if ($tot > 0 && $tot < 4) {
                    $resultS[] = '1-3';
                }
                if ($tot > 2 && $tot < 4) {
                    $resultS[] = '2-3';
                }
                if ($tot > 3) {
                    $resultS[] = '4+';
                }
                $result = $resultS;
                break;
            case 56:
                $scored = $ft_score[0] + $ft_score[1];
                $result = $scored > $special_bet_value ? 'Over' : 'Under';
                break;
            case 262:
                $half_1 = ($ht_score[0] + $ht_score[1] > 4) ? '4plus' : $ht_score[0] . '-' . $ht_score[1];
                $fttime = ($ft_score[0] + $ft_score[1] > 4) ? '4plus' : $ft_score[0] . '-' . $ft_score[1];
                $result = $half_1 . ' ' . $fttime;
                break;
            case 329:
                $result = ((($ft_score[0] - $ht_score[0]) > 0) && (($ft_score[1] - $ht_score[1]) > 0)) ? 'Yes' : 'No';
                break;
            case 44:
                $win_half = $ht_score[0] > $ht_score[1] ? '1' : ($ht_score[0] == $ht_score[1] ? 'X' : 2);
                $win_ft = $ft_score[0] > $ft_score[1] ? '1' : ($ft_score[0] == $ft_score[1] ? 'X' : 2);
                $result = $win_half . '/' . $win_ft;
                break;
            case 385:
                $result = $ft_score[0] . ':' . $ft_score[1];
                break;
            case 323:
                $result = $ht_score[0] > $ht_score[1] ? ['1X', '12'] : (($ht_score[0] == $ht_score[1]) ? ['1X', 'X2'] : ['X2', '12']);
                break;
            case 43:
                $result = ($ft_score[0] > 0 && $ft_score[1] > 0) ? 'Yes' : 'No';
                break;
            case 46:
                $result = $ft_score[0] > $ft_score[1] ? ['1X', '12'] : (($ft_score[0] == $ft_score[1]) ? ['1X', 'X2'] : ['X2', '12']);
                break;
            case 381:
                $result = ($ft_score[0] > $ft_score[1]) ? 1 : (($ft_score[0] == $ft_score[1]) ? 'X' : 2);
                break;
            case 322:
                $tot = [$ht_score[0] + $ht_score[1], $ft_score[0] + $ft_score[1]];
                $result = ($tot[0] < 2 && $tot[1] - $tot[0] < 2) ? 'Yes' : 'No';
                break;
            case 55:
                $sp_values = explode(":", $special_bet_value);
                if (count($sp_values) == 2) {
                    $win_result = [$ft_score[0] + $sp_values[0], $ft_score[1] + $sp_values[1]];
                    $result = ($win_result[0] > $win_result[1]) ? 1 : (($win_result[0] == $win_result[1]) ? 'X' : 2);
                } else {
                    return false;
                }
                break;
            case 269:
                $result = ($ft_score[0] > 0 && $ft_score[1] > 0) ? 'Both teams' : ($ft_score[0] > 0 ? '1' : ($ft_score[1] > 0 ? '2' : 'None'));
                break;
            case 45:
                $result = ($ft_score[0] + $ft_score[1]) % 2 == 0 ? 'Even' : 'Odd';
                break;
            case 402:
                $result = ($ft_score[0] - $ht_score[0]) . ':' . ($ft_score[1] - $ht_score[1]);
                break;
            case 384:
                $sp_values = explode(":", $special_bet_value);
                if (count($sp_values) == 2) {
                    $win_result = [$ft_score[0] + $sp_values[0], $ft_score[1] + $sp_values[1]];
                    $result = ($win_result[0] > $win_result[1]) ? 1 : (($win_result[0] == $win_result[1]) ? 'X' : 2);
                } else {
                    return false;
                }
                break;
            case 383:
                $scored = $ft_score[0] + $ft_score[1];
                $result = $scored > $special_bet_value ? 'Over' : 'Under';
                break;
            case 328:
                $result = ($ht_score[0] > 0 && $ht_score[1] > 0) ? 'Yes' : 'No';
                break;
            case 267:
                $result = ($ft_score[1] == 0) ? 'Yes' : 'No';
                break;
            case 48:
                $result = $ft_score[0];
                break;
            case 258:
                $tot = (String) ($ft_score[0] + $ft_score[1]);
                $result = ($ft_score[0] + $ft_score[1]) < 6 ? $tot : "6+";
                break;
            case 270:
                $tot = (String) ($ht_score[0] + $ht_score[1]);
                $result = (($ht_score[0] + $ht_score[1]) < 2) ? $tot : "2+";
                break;
            case 321:
                $result = (($ht_score[0] + $ht_score[1] > 1) && (($ft_score[0] - $ht_score[0]) + ($ft_score[1] - $ht_score[1]) > 1)) ? 'Yes' : 'No';
                break;
            case 320:
                $result = (($ht_score[1] > 0) && (($ft_score[1] - $ht_score[1]) > 0)) ? 'Yes' : 'No';
                break;
            case 317:
                $result = (($ht_score[0] > 0) && (($ft_score[0] - $ht_score[0]) > 0)) ? 'Yes' : 'No';
                break;
            case 47:
                $result = (($ft_score[0] > $ft_score[1]) ? 1 : (($ft_score[0] == $ft_score[1]) ? "X" : 2));
                break;
            case 208:
                $scored = $ft_score[0] + $ft_score[1];
                $ovun = $scored > $special_bet_value ? 'Over' : 'Under';
                $threeway = (($ft_score[0] > $ft_score[1]) ? "home" : (($ft_score[0] == $ft_score[1]) ? 'draw' : "away"));

                $result = $ovun . " and " . $threeway;
                break;
            case 414:
                $btts = (($ft_score[0] > 0) && ($ft_score[1] > 0)) ? "Yes" : "No";
                $over25 = (($ft_score[0] + $ft_score[1]) > 2) ? "Over" : "Under";
                $result = $btts . " / " . $over25;
                break;
            case 268:
                $result = ($ft_score[0] == 0) ? 'Yes' : 'No';
                break;
            case 352:
                $awscored = $ft_score[1];
                $result = $awscored > $special_bet_value ? 'Over' : 'Under';
                break;
            case 353:
                $hmscored = $ft_score[0];
                $result = $hmscored > $special_bet_value ? 'Over' : 'Under';
                break;
            case 336:
                $hmscore_2ndDC = $ft_score[0] - $ht_score[0];
                $awscore_2ndDC = $ft_score[1] - $ht_score[1];
                $result = $hmscore_2ndDC > $awscore_2ndDC ? ['1X', '12'] : (($hmscore_2ndDC == $awscore_2ndDC) ? ['1X', 'X2'] : ['X2', '12']);
                break;
            case 259:
                $hmscore_2nd_1x2 = $ft_score[0] - $ht_score[0];
                $awscore_2nd_1x2 = $ft_score[1] - $ht_score[1];
                $result = ($hmscore_2nd_1x2 > $awscore_2nd_1x2) ? 1 : (($hmscore_2nd_1x2 == $awscore_2nd_1x2) ? 'X' : 2);
                break;
            case 271:
                $hm_goals_2nd = $ft_score[0] - $ht_score[0];
                $aw_goals_2nd = $ft_score[1] - $ht_score[1];

                $goals2ndHf = $hm_goals_2nd + $aw_goals_2nd;
                $result = (($goals2ndHf >= 2) ? "2+" : $goals2ndHf);
                break;
            // Cleansheet and Home to win
            case 81054:
                $result = ($ht_score[0] > 0 && $ht_score[1] == 0) ? "Yes" : "No";
                break;
            // Cleanssheet and Away team to win
            case 81056:
                $result = ($ht_score[0] == 0 && $ht_score[1] > 0) ? "Yes" : "No";
                break;
            // Halftime Matchbet and Totals
            case 81529:
                $scored = $ht_score[0] + $ht_score[1];
                $ovun =  ($scored > $special_bet_value) ? "Over" : "Under";
                $matchbet = ($ht_score[0] > $ht_score[1])? "Home":(($ht_score[0] == $ht_score[1])? "Draw" : "Away");
                $result = $matchbet . " and " . $ovun;
                break;
            // Matchbet + Both Teams To Score
            case 386:
                $matchbet = ($ft_score[0] > $ft_score[1]) ? "Home": (($ft_score[0] == $ft_score[1])? "Draw" : "Away");
                $bothTeams = ($ft_score[0] > 0 && $ft_score[1] > 0) ? 'Yes' : 'No';
                $result = $matchbet . ' and ' . $bothTeams;
                break;
            // Away to win both halves  
            case 318:
                $result = ($ht_score[1] > $ht_score[0] && $ft_score[1] > $ft_score[0]) ? 'Yes' : 'No';
                break;
            // 1st Half -  Cleansheet Away Team
            case 395:
                $result = ($ht_score[0] == 0) ? 'Yes' : 'No';
                break;
            // 1st Half -  Cleansheet Home Team
            case 394:
                $result = ($ht_score[1] == 0) ? 'Yes' : 'No';
                break;
            // Home Team To Win Either Half
            case 316:
                $result = ($ht_score[0] > $ht_score[1] || $ft_score[0] > $ft_score[1]) ? 'Yes' : 'No';
                break;
            // Away Team To Win Either Half
            case 319:
                $result = ($ht_score[1] > $ht_score[0] || $ft_score[1] > $ft_score[0])? 'Yes': 'No';
                break;
            // 1st Half Matchbet and Totals
            case 412:
                $matchbet = ($ht_score[0] > $ht_score[1])? "Home": (($ht_score[0] == $ht_score[1]) ? "Draw" : "Away");
                $scored = $ht_score[0] + $ht_score[1];
                $ovun =  ($scored > $special_bet_value)? "Over": "Under";

                $result = $matchbet . " and " . $ovun;
                break;
            default:
                $result = null;
                break;
        }


        return $result;
    }

    public function getBookingConnerWoutcome($sub_type_id, $totals, $special_bet_value) {
        Yii::info("::get winning outcome ::$sub_type_id, $totals, $special_bet_value", self::log);
        $result = NULL;
        switch ($sub_type_id) {
            case 139:
            case 162:
                $result = ((float) $totals > (float) $special_bet_value) ? 'Over' : 'Under';
                break;
            default :
                return NULL;
        }
        return $result;
    }

    /**
     * 
     * @param type $sub_type_id
     * @param type $ht_score
     * @param type $ft_score
     * @param type $odd_key
     * @param type $special_bet_value
     * @return type
     */
    /*
     * 
     * +----------------------------------+-------------+---------+-------------------+
      | name                             | sub_type_id | odd_key | special_bet_value |
      +----------------------------------+-------------+---------+-------------------+
      | 2 Way                            |          20 | 1       |                   |
      | 2 Way                            |          20 | 2       |                   |
      | Asian Handicap                   |          51 | 1       | -2.5              |
      | Asian Handicap                   |          51 | 2       | -2.5              |
      | 1st Set Winner                   |         204 | 1       |                   |
      | 1st Set Winner                   |         204 | 2       |                   |
      | Total Number of Sets (best of 3) |         206 | 2 sets  |                   |
      | Total Number of Sets (best of 3) |         206 | 3 sets  |                   |
      | Total                            |         226 | Over    | 22.5              |
      | Total                            |         226 | Under   | 22.5              |
      | 1st Set - Game Handicap          |         339 | 1       | -1.5              |
      | 1st Set - Game Handicap          |         339 | 2       | -1.5              |
      | 1st Set - Total                  |         340 | Over    | 10.5              |
      | 1st Set - Total                  |         340 | Under   | 10.5              |
      | 2 Way                            |         382 | 1       |                   |
      | 2 Way                            |         382 | 2       |                   |
      | Player 1 to win a set            |         437 | No      |                   |
      | Player 1 to win a set            |         437 | Yes     |                   |
      | Player 2 to win a set            |         438 | No      |                   |
      | Player 2 to win a set            |         438 | Yes     |                   |
      | Set Handicap                     |         439 | 1       | -1.5              |
      | Set Handicap                     |         439 | 1       | 1.5               |
      | Set Handicap                     |         439 | 2       | -1.5              |
      | Set Handicap                     |         439 | 2       | 1.5               |
      +----------------------------------+-------------+---------+-------------------+
     */

    public function getTennisWinningOutcome($sub_type_id, $sets_count, $set_scores, $odd_key, $special_bet_value = null) {
        Yii::info("::get tennis winning outcome ::$sub_type_id, $ht_score[0], $ft_score[0], $special_bet_value", self::log);
        switch ($sub_type_id) {
            case 20:
                $result = (($ft_score[0] > $ft_score[1]) ? 1 : (($ft_score[0] == $ft_score[1]) ? 'X' : 2));
                break;
            case 2:
                $result = $ft_score[0] . ':' . $ft_score[1];
                break;
            default:
                $result = null;
                break;
        }

        return $result;
    }

    public function actionIcehockeyresulting() {

        $model = new \app\models\BetSlip();

        $model->load(Yii::$app->request->post());
        $output = "";
        $message = "Bad Request";
        if (Yii::$app->request->post()) {

            /* results calculation */
            $stPeriod_score = $model->stPeriod_score;
            $ndPeriod_score = $model->ndPeriod_score;
            $rdPeriod_score = $model->rdPeriod_score;
            $aotscore = $model->AOT_score;

            $sport_data = $model->match_sport($model->parent_match_id);

            $sport_id = isset($sport_data['sport_id']) ? $sport_data['sport_id'] : "";

            if ($model->parent_match_id != null && $sport_id == 29) {

                $valid_sub_types = \app\models\EventOdd::find()->where(['=', 'parent_match_id', $model->parent_match_id])->all();

                $stPeriod = explode(":", $stPeriod_score);
                $ndPeriod = explode(":", $ndPeriod_score);
                $rdPeriod = explode(":", $rdPeriod_score);
                $aotperiod = explode(":", $aotscore);

                $homescore = $stPeriod[0] + $ndPeriod[0] + $rdPeriod[0] + $aotperiod[0];
                $awayscore = $stPeriod[1] + $ndPeriod[1] + $rdPeriod[1] + $aotperiod[1];

                $output = $homescore . " - " . $awayscore;

                if (count($stPeriod) != 2 || count($ndPeriod) != 2 || count($rdPeriod) != 2 || count($aotperiod) != 2) {
                    $message = 'Provided wrong format of scores. Format is x:y.';
                    echo json_encode(array("output" => 'Error', "message" => $message));
                }

                foreach ($valid_sub_types as $valid_sub_type) {

                    $winning_outcome = $this->getIceHockeyWinningOutcome($valid_sub_type->sub_type_id, $stPeriod, $ndPeriod, $rdPeriod, $aotperiod, $valid_sub_type->odd_key, $valid_sub_type->special_bet_value);

                    if ($winning_outcome == null) {
                        continue;
                    }
                    if (is_array($winning_outcome)) {
                        foreach ($winning_outcome as $key => $outcome) {
                            $this->saveOutcomeToDb($model, $valid_sub_type, $outcome, $homescore, $awayscore, FALSE);
                        }
                    } else {
                        $this->saveOutcomeToDb($model, $valid_sub_type, $winning_outcome, $homescore, $awayscore, FALSE);
                    }
                }
                $message = 'Operation succeded. Outcome created kindly go to approval page to approve it for processing.';
            }
        }

        echo json_encode(array("output" => $output, "message" => isset($message) ? $message : ""));
    }

    /**
     * 
     * @param type $sub_type_id
     * @param type $stperiod
     * @param type $ndperiod
     * @param type $rdperiod
     * @param type $aotPeriod
     * @param type $odd_key
     * @param type $special_bet_value
     * @return type
     */
    public function getIceHockeyWinningOutcome($sub_type_id, $stperiod, $ndperiod, $rdperiod, $aotPeriod, $odd_key, $special_bet_value = null) {

        switch ($sub_type_id) {
            case 10:
                $home_total = $stperiod[0] + $ndperiod[0] + $rdperiod[0];
                $away_total = $stperiod[1] + $ndperiod[1] + $rdperiod[1];
                $result = ($home_total > $away_total) ? "1" : ($home_total == $away_total) ? "X" : "2";
                break;
            case 41:
                $result = (($stperiod[0] == 0) && ($stperiod[1] == 0)) ? "None" :
                        (($stperiod[0] > 0) && ($stperiod[1] == 0)) ? "1" :
                                (($stperiod[0] == 0) && ($stperiod[1] > 0)) ? "2" : NULL;
                break;
            case 43:
                $home_total = $stperiod[0] + $ndperiod[0] + $rdperiod[0];
                $away_total = $stperiod[1] + $ndperiod[1] + $rdperiod[1];
                $result = (($home_total > 0) && ($away_total > 0)) ? "Yes" : "No";
                break;
            case 46:
                $home_total = $stperiod[0] + $ndperiod[0] + $rdperiod[0];
                $away_total = $stperiod[1] + $ndperiod[1] + $rdperiod[1];
                $result = ($home_total > $away_total) ? ["12", "1X"] : ($home_total == $away_total) ? ["1X", "X2"] : ["12", "X2"];
                break;
            case 60:
                $home_total = $stperiod[0] + $ndperiod[0] + $rdperiod[0];
                $away_total = $stperiod[1] + $ndperiod[1] + $rdperiod[1];
                $result = ($home_total + $away_total) > $special_bet_value ? "Over" : "Under";
                break;
            case 208:
                $home_total = $stperiod[0] + $ndperiod[0] + $rdperiod[0];
                $away_total = $stperiod[1] + $ndperiod[1] + $rdperiod[1];
                $match_totals = ($home_total + $away_total) > $special_bet_value ? "Over" : "Under";
                $match_bet = ($home_total > $away_total) ? "home" : ($home_total == $away_total) ? "draw" : "away";
                $result = $match_totals . " / " . $match_bet;
                break;
            case 210:
                $result = ($stperiod[0] > $stperiod[1]) ? "1" : ($stperiod[0] == $stperiod[1]) ? "X" : "2";
                break;
            case 212:
                $result = (($stperiod[0] + $stperiod[1]) > $special_bet_value) ? "Over" : "Under";
                break;
            case 314:
                $result = (($stperiod[0] > 0) && ($stperiod[1] > 0)) ? "Yes" : "No";
                break;
            case 352:
                $away_total = $stperiod[1] + $ndperiod[1] + $rdperiod[1];
                $result = $away_total > $special_bet_value ? "Over" : "Under";
                break;
            case 353:
                $home_total = $stperiod[0] + $ndperiod[0] + $rdperiod[0];
                $result = $home_total > $special_bet_value ? "Over" : "Under";
                break;
            case 377:
                $home_total = $stperiod[0] + $ndperiod[0] + $rdperiod[0] + $aotPeriod[0];
                $away_total = $stperiod[1] + $ndperiod[1] + $rdperiod[1] + $aotPeriod[1];
                $result = ($home_total + $away_total) > $special_bet_value ? "Over" : "Under";
                break;
            case 378:
                $result = NULL;
                break;
            case 381:
                $home_total = $stperiod[0] + $ndperiod[0] + $rdperiod[0];
                $away_total = $stperiod[1] + $ndperiod[1] + $rdperiod[1];
                $result = ($home_total > $away_total) ? "1" : ($home_total == $away_total) ? "X" : "2";
                break;
            // Cleansheet and Home to win
            case 81054:
                $result = ($ht_score[0] > 0 && $ht_score[1] == 0) ? "Yes" : "No";
                break;

            // Cleanssheet and Away team to win
            case 81056:
                $result = ($ht_score[0] == 0 && $ht_score[1] > 0) ? "Yes" : "No";
                break;

            // Halftime Matchbet and Totals
            case 81529:
                $scored = $ht_score[0] + $ht_score[1];
                $ovun =  ($scored > $special_bet_value) ? "Over" : "Under";
                $matchbet = ($ht_score[0] > $ht_score[1])? "Home":(($ht_score[0] == $ht_score[1])? "Draw" : "Away");
                $result = $matchbet . " and " . $ovun;
                break;
            // Matchbet + Both Teams To Score
            case 386:
                $matchbet = ($ft_score[0] > $ft_score[1]) ? "Home": (($ft_score[0] == $ft_score[1])? "Draw" : "Away");
                $bothTeams = ($ft_score[0] > 0 && $ft_score[1] > 0) ? 'Yes' : 'No';
                $result = $matchbet . ' and ' . $bothTeams;
                break;
            // Away to win both halves  
            case 318:
                $result = ($ht_score[1] > $ht_score[0] && $ft_score[1] > $ft_score[0]) ? 'Yes' : 'No';
                break;
            // 1st Half -  Cleansheet Away Team
            case 395:
                $result = ($ht_score[0] == 0) ? 'Yes' : 'No';
                break;
            // 1st Half -  Cleansheet Home Team
            case 394:
                $result = ($ht_score[1] == 0) ? 'Yes' : 'No';
                break;
            // Home Team To Win Either Half
            case 316:
                $result = ($ht_score[0] > $ht_score[1] || $ft_score[0] > $ft_score[1]) ? 'Yes' : 'No';
                break;
            // Away Team To Win Either Half
            case 319:
                $result = ($ht_score[1] > $ht_score[0] || $ft_score[1] > $ft_score[0])? 'Yes': 'No';
                break;
            // 1st Half Matchbet and Totals
            case 412:
                $matchbet = ($ht_score[0] > $ht_score[1])? "Home": (($ht_score[0] == $ht_score[1]) ? "Draw" : "Away");
                $scored = $ht_score[0] + $ht_score[1];
                $ovun =  ($scored > $special_bet_value)? "Over": "Under";

                $result = $matchbet . " and " . $ovun;
                break;
            default :
                $result = NULL;
        }
        return $result;
    }

}
