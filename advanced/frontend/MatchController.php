<?php

namespace frontend\controllers;

use Yii;
use app\models\Match;
use app\models\MatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * MatchController implements the CRUD actions for Match model.
 */
class MatchController extends Controller {

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
            ]
        ];
    }

    /**
     * Lists all Match models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MatchSearch();
        $model = new Match();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        \Yii::info("matches index ..............", 'debug');

        return $this->render('index', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Match model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Match model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Match();
        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Operation succeeded, match was created.'
                ]);
                return $this->redirect(['view', 'id' => $model->match_id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } catch (yii\db\IntegrityException $exc) {
            Yii::error("EXCEPTION update match ::" . $exc->getMessage());
            Yii::$app->getSession()->setFlash('error', [
                'message' => 'Operation failed, match could not be created. Please try again later or contact Tech.'
            ]);
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Match model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        try {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', [
                    'message' => 'Operation succeeded, match was updated.'
                ]);
                return $this->redirect(['view', 'id' => $model->match_id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } catch (yii\db\IntegrityException $exc) {
            Yii::error("EXCEPTION create match ::" . $exc->getMessage());
            Yii::$app->getSession()->setFlash('error', [
                'message' => 'Operation failed, match could not be updated. Please try again later or contact Tech.'
            ]);
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Match model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Match model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Match the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Match::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSendDailyMatch() {
        $model = new Match();
        return $this->render('send-daily-match', [
                    'model' => $model,
        ]);
    }

}
