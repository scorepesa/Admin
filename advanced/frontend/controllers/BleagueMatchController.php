<?php

namespace frontend\controllers;

use Yii;
use app\models\BleagueMatch;
use frontend\models\BleagueMatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BleagueMatchController implements the CRUD actions for BleagueMatch model.
 */
class BleagueMatchController extends Controller
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
     * Lists all BleagueMatch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BleagueMatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BleagueMatch model.
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
     * Creates a new BleagueMatch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BleagueMatch();

        if ($model->load(Yii::$app->request->post())) {
            // get data from post
            $parent_match_ids = $_POST["parent_match_id"];
            print_r($parent_match_ids);die();

            // call function in model to save data
            $result = $model->add_matches($parent_match_ids);

            if($result) {
                $msg = "Matches added to successfully.";
                $error = 'success';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect(['index']);

            } else {
                $msg = "Error in operation.";
                $error = 'error';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect('index');
            }

        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }



    }

    /**
     * Updates an existing BleagueMatch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->match_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BleagueMatch model.
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
     * Finds the BleagueMatch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BleagueMatch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BleagueMatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddmatches() {
        $model = new BleagueMatch();

        if ($model->load(Yii::$app->request->post())) {
            // get data from post
            $parent_match_ids = $_POST["parent_match_id"];
            //print_r($parent_match_ids);die();

            // call function in model to save data
            $result = $model->add_matches($parent_match_ids);

            if($result) {
                $msg = "Matches added successfully.";
                $error = 'success';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect(['index']);

            } else {
                $msg = "Error in operation.";
                $error = 'error';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect('index');
            }

        } else {
            return $this->render('create_matches', [
                        'model' => $model,
            ]);
        }



    }
}
