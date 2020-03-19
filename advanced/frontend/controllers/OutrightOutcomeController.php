<?php

namespace frontend\controllers;

use Yii;
use app\models\OutrightOutcome;
use app\models\OutrightOutcomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OutrightOutcomeController implements the CRUD actions for OutrightOutcome model.
 */
class OutrightOutcomeController extends Controller {

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
     * Lists all OutrightOutcome models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new OutrightOutcomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOutrightsResults() {
        $_get = Yii::$app->request->get();
        $_outcome = new OutrightOutcome();
        $otcsearch = new OutrightOutcomeSearch();
        $model = new \app\models\Outright();
        $dropdwnmodel = new \app\models\DropDownActionColumn();
        $model->load(Yii::$app->request->post());

        $searchModel = new \app\models\OutrightSearch();
        $dataProvider = $searchModel->searchResulting(Yii::$app->request->queryParams);
        $otcdataProvider = $otcsearch->search(Yii::$app->request->queryParams);

        return $this->render('outrights-results', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'outcome' => $_outcome,
                    'otcdataProvider' => $otcdataProvider,
                    'dropdwn' => $dropdwnmodel,
                    'bsmodel' => $model
        ]);
    }

    /**
     * Displays a single OutrightOutcome model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OutrightOutcome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new OutrightOutcome();
        try {
            $queue_name = 'SCOREPESA_OUTCOMES_QUEUE2';
            $exchange = 'SCOREPESA_OUTCOMES_QUEUE2';
            $_outcome = array();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $_data = array(
                    "outcomeSaveId" => $model->outcome_id,
                    "outcomeKey" => (string) 1,
                    "outcomeValue" => (string) $model->outcome,
                    "voidFactor" => 0,
//                    "odd_type" => $model->odd_type,
                    "specialBetValue" => ''
                );
                array_push($_outcome, $_data);

                $data = array(
                    "parent_outright_id" => $model->parent_outright_id,
                    "outcomes" => $_outcome
                );

                $message = json_encode($data);

                try {
                    Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                    Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                    Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
                    Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);
                } catch (Exception $exc) {
                    Yii::error("EXCEPTION MQ CONNECTION ::" . $exc->getMessage());
                }
                return $this->redirect(['view', 'id' => $model->outcome_id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } catch (Exception $exc) {
            Yii::error("EXCEPTION Posting Outrights outcome to queue to Queue ::" . $exc->getMessage());
            return FALSE;
        }
    }

    public function outrightPushToQueue() {
        $model = new \app\models\OutrightOutcome();
        try {
            $queue_name = 'SCOREPESA_OUTCOMES_QUEUE2';
            $exchange = 'SCOREPESA_OUTCOMES_QUEUE2';

            if ($model->save()) {
                $_outcome = array(
                    "outcomeSaveId" => $model->outcome_id,
                    "outcomeKey" => (string) 1,
                    "outcomeValue" => (string) $model->outcome,
                    "voidFactor" => 0,
                    "odd_type" => $model->odd_type,
                    "specialBetValue" => ''
                );

                $data = array(
                    "parent_outright_id" => $model->parent_outright_id,
                    "outcomes" => $_outcome
                );

                $message = json_encode($data);

                try {
                    Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                    Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                    Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
                    Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);
                } catch (Exception $exc) {
                    Yii::error("EXCEPTION MQ CONNECTION ::" . $exc->getMessage());
                }
                return TRUE;
            } else {
                return TRUE;
            }
        } catch (Exception $exc) {
            Yii::error("EXCEPTION Posting Outrights outcome to queue to Queue ::" . $exc->getMessage());
            return FALSE;
        }
    }

    /**
     * Updates an existing OutrightOutcome model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        try {
            $queue_name = 'SCOREPESA_OUTCOMES_QUEUE2';
            $exchange = 'SCOREPESA_OUTCOMES_QUEUE2';
            $_outcome = array();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $_data = array(
                    "outcomeSaveId" => $model->outcome_id,
                    "outcomeKey" => (string) 1,
                    "outcomeValue" => (string) $model->outcome,
                    "voidFactor" => 0,
                    "specialBetValue" => ''
                    //"odd_type" => $model->odd_type
                );
                if (!empty($model->special_bet_value)):
                    $_data["specialBetValue"] = $model->special_bet_value;
                endif;
                array_push($_outcome, $_data);
                $data = array(
                    "parent_match_id" => $model->parent_outright_id,
                    "outcomes" => $_outcome
                );

                $message = json_encode($data);

                Yii::$app->amqp->declareExchange($exchange, $type = 'direct', $passive = false, $durable = false, $auto_delete = false);
                Yii::$app->amqp->declareQueue($queue_name, $passive = false, $durable = true, $exclusive = false, $auto_delete = false);
                Yii::$app->amqp->bindQueueExchanger($queue_name, $exchange, $routingKey = $queue_name);
                Yii::$app->amqp->publish_message($message, $exchange, $routingKey = $queue_name, $content_type = 'applications/json', $app_id = Yii::$app->name);

                return $this->redirect(['view', 'id' => $model->outcome_id]);
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

    /**
     * Deletes an existing OutrightOutcome model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OutrightOutcome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OutrightOutcome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = OutrightOutcome::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
