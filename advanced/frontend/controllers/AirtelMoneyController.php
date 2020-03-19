<?php

namespace frontend\controllers;

use Yii;
use app\models\AirtelMoney;
use app\models\AirtelMoneySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AirtelMoneyController implements the CRUD actions for AirtelMoney model.
 */
class AirtelMoneyController extends Controller {

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
     * Lists all AirtelMoney models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AirtelMoneySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AirtelMoney model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionUploadAirtelxls() {
        $model = new \app\models\UploadXlsForm();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isPost) {
            $model->mediaFile = UploadedFile::getInstance($model, 'mediaFile');
            if ($model->uploadAirtel()) {
                // file is uploaded successfully
                return ['output' => 'Upload Airtel file', 'message' => 'Success!'];
            }
        }

        return ['output' => 'Upload Airtel file', 'message' => 'FAILED!'];
    }

    /**
     * Creates a new AirtelMoney model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AirtelMoney();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AirtelMoney model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->id]);
          } else { */
        return $this->render('update', [
                    'model' => $model,
        ]);
//        }
    }

    /**
     * Deletes an existing AirtelMoney model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
//        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AirtelMoney model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AirtelMoney the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AirtelMoney::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
