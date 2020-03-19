<?php

namespace frontend\controllers;

use Yii;
use frontend\models\UserBetCancel;
use frontend\models\UserBetCancelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserBetCancelController implements the CRUD actions for UserBetCancel model.
 */
class UserBetCancelController extends Controller {

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
     * Lists all UserBetCancel models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserBetCancelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserBetCancel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserBetCancel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new UserBetCancel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
            // Cancel Bet
            // $result = $model->cancelBet($model->bet_id);

            /* if($result) {
              return $this->redirect(['view', 'id' => $model->id]);
              } else {
              return $this->render('create', [
              'model' => $model,
              ]);
              } */
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserBetCancel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserBetCancel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserBetCancel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserBetCancel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = UserBetCancel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionManualcreate() {
        $model = new UserBetCancel();

        if (Yii::$app->request->post()) {

            $model->load(Yii::$app->request->post());
            $data = trim($model->bet_id);

            $created_by = $model->created_by;

            $result = $model->updateBets($data, $created_by);
            if ($result) {
                $msg = "Bet(s) submitted for cancellation.";
                $error = 'info';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect(['index']);
            } else {
                return $this->redirect('manualcreate');
            }
        } else {
            return $this->render('manual_create', [
                        'model' => $model,
            ]);
        }
    }

}
