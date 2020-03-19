<?php

namespace frontend\controllers;

use Yii;
use app\models\JackpotMatch;
use app\models\JackpotMatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JackpotMatchController implements the CRUD actions for JackpotMatch model.
 */
class JackpotMatchController extends Controller {

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
     * Lists all JackpotMatch models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new JackpotMatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JackpotMatch model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JackpotMatch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new JackpotMatch();

        if ($model->load(Yii::$app->request->post())) {
            // get data from post
            $parent_match_ids = $_POST["parent_match_id"];
            $status           = 'ACTIVE'; 
            //$model->status;
            $jackpot_event_id = $model->jackpot_event_id;
            $game_order       = $model->game_order;
            $created_by       = $model->created_by;
            $created          = $model->created;
            //print_r($data);die();

            // call function in model to save data
            $result = $model->saveJpMatches($parent_match_ids, $status, $created_by, $created, $jackpot_event_id, $game_order);

            if($result) {
                $msg = "Matches added to jackpot event successfully.";
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
     * Updates an existing JackpotMatch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->jackpot_match_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing JackpotMatch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JackpotMatch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JackpotMatch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = JackpotMatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

