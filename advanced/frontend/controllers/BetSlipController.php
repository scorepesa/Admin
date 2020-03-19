<?php

namespace frontend\controllers;

use Yii;
use app\models\Bet;
use app\models\BetSlip;
use app\models\BetSlipSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * BetSlipController implements the CRUD actions for BetSlip model.
 */
class BetSlipController extends Controller {

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
     * Lists all BetSlip models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new \app\models\BetSlipMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BetSlip model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BetSlip model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new BetSlip();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bet_slip_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BetSlip model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bet_slip_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BetSlip model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BetSlip model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BetSlip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = BetSlip::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionVoidmatch() {
        $model = new BetSlip();
        $match_model = new \app\models\Match();

        if ($model->load(Yii::$app->request->post())) {

            $result = $model->voidMatch(array($model->parent_match_id));
            if ($result) {
                //success
                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Operation on voiding succeded.'
                ]);
            } else {
                //fail    
                Yii::$app->getSession()->setFlash('error', [
                    'message' => 'Operation voiding failed. Please retry again, if the error persists contact Tech.'
                ]);
            }
            return $this->redirect(['voidmatch']);
        } else {
            return $this->render('voidmatch', [
                        'model' => $model,
                        'match_model' => $match_model
            ]);
        }
    }


    public function actionVoidlivematch() {
        $model = new BetSlip();
        $match_model = new \app\models\LiveMatch();

        if ($model->load(Yii::$app->request->post())) {

            $result = $model->voidMatch(array($model->parent_match_id), null, $model->live_bet);
            if ($result) {
                //success
                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Operation on voiding succeded.'
                ]);
            } else {
                //fail    
                Yii::$app->getSession()->setFlash('error', [
                    'message' => 'Operation voiding failed. Please retry again, if the error persists contact Tech.'
                ]);
            }
            return $this->redirect(['voidlivematch']);
        } else {
            return $this->render('voidlivematch', [
                        'model' => $model,
                        'match_model' => $match_model
            ]);
        }
    }


    public function actionVoidmarket() {
        $model = new BetSlip();
        $match_model = new \app\models\Match();

        if ($model->load(Yii::$app->request->post())) {

            $result = $model->voidMatch(array($model->parent_match_id), $model->sub_type_id, $model->live_bet);
            if ($result) {
                //success
                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Market Operation on voiding succeded.'
                ]);
            } else {
                //fail    
                Yii::$app->getSession()->setFlash('error', [
                    'message' => 'Market Operation voiding failed. Please retry again, if the error persists contact Tech.'
                ]);
            }
            return $this->redirect(['voidmarket']);
        } else {
            return $this->render('voidmarket', [
                        'model' => $model,
                        'match_model' => $match_model
            ]);
        }
    }

    public function actionVoidlivemarket() {
        $model = new BetSlip();
        $match_model = new \app\models\LiveMatch();

        if ($model->load(Yii::$app->request->post())) {

            $result = $model->voidMatch(array($model->parent_match_id), $model->sub_type_id, $model->live_bet);
            if ($result) {
                //success
                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Live Market Operation on voiding succeded.'
                ]);
            } else {
                //fail    
                Yii::$app->getSession()->setFlash('error', [
                    'message' => 'Live Market Operation voiding failed. Please retry again, if the error persists contact Tech.'
                ]);
            }
            return $this->redirect(['voidlivemarket']);
        } else {
            return $this->render('voidlivemarket', [
                        'model' => $model,
                        'match_model' => $match_model
            ]);
        }
    }


}
