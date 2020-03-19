<?php

namespace frontend\controllers;

use Yii;
use app\models\BleagueEventOdd;
use app\models\BetSlip;
use frontend\models\BleagueEventOddSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BleagueEventOddController implements the CRUD actions for BleagueEventOdd model.
 */
class BleagueEventOddController extends Controller
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
     * Lists all BleagueEventOdd models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BleagueEventOddSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider1 = $searchModel->processed(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProvider1' => $dataProvider1,
        ]);
    }

    /**
     * Displays a single BleagueEventOdd model.
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
     * Creates a new BleagueEventOdd model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BleagueEventOdd();

        if ($model->load(Yii::$app->request->post())) {

            // explode from form using ','
            $data = rtrim($model->odd_key, ' ');

            $key_value = explode(',', $data);

            foreach ($key_value as $key => $value) {
                // explode using '='
                $data = explode('=', $value);
                
                $odd_key   = $data[0];
                $odd_value = $data[1];

                $model->max_bet       = 20000;
                $model->odd_key       = $odd_key;
                $model->odd_value     = $odd_value;
                $model->special_bet_value = $model->odd_key; 
                $model->odd_alias     = null;

                $result = $model->saveOdds($model->parent_match_id, $model->sub_type_id, $model->max_bet, $model->created_by, $model->created, $model->modified, $model->odd_key, $model->odd_value, $model->special_bet_value, $model->odd_alias, $model->status);

                //$model->save(); 
                              
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BleagueEventOdd model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->event_odd_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BleagueEventOdd model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BleagueEventOdd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BleagueEventOdd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BleagueEventOdd::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionResult($winning_outcome, $sub_type_id, $parent_match_id, $created_by, $event_odd_id, $special_bet_value) {

        $model = new BleagueEventOdd();

        //$special_bet_value = null;
        $live_bet          = 0;
        $approved_by       = null;
        $created           = date('"Y-m-d H:i:s');
        $modified          = date('"Y-m-d H:i:s');
        //$special_bet_value = null;
        $status            = 0;
        $approved_status   = 0;
        $date_approved     = date("Y-m-d H:i:s");


        // if void
        if($winning_outcome == '-1') {
            $bet_slip = new BetSlip();
            $result = $bet_slip->voidMatch($parent_match_id, $sub_type_id);
        
            $void_factor = "1";
            $result = $model->processOutcome($sub_type_id, $parent_match_id, $special_bet_value, $live_bet, $created_by, $created, $modified, $status, $approved_by, $approved_status, $date_approved, $winning_outcome, $event_odd_id, $void_factor);

            if($result) {
                $msg = "Event Outcome Voided Successfully.";
                $error = 'success';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect(['index']);
            }

        } else {
            $void_factor = "0";
            $result = $model->processOutcome($sub_type_id, $parent_match_id, $special_bet_value, $live_bet, $created_by, $created, $modified, $status, $approved_by, $approved_status, $date_approved, $winning_outcome, $event_odd_id, $void_factor);

            if($result) {
                $msg = "Event Outcome Processed Successfully.";
                $error = 'success';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect(['index']);
            }
        }

       

    }
}
