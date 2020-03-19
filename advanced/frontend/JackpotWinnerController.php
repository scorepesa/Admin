<?php

namespace frontend\controllers;

use Yii;
use app\models\JackpotWinner;
use app\models\JackpotMatch;
use app\models\JackpotWinnerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JackpotWinnerController implements the CRUD actions for JackpotWinner model.
 */
class JackpotWinnerController extends Controller {

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
     * Lists all JackpotWinner models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new JackpotWinnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JackpotWinner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JackpotWinner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new JackpotWinner();
        $jpmatch_model = new JackpotMatch();

        if ($model->load(Yii::$app->request->post())) {
            //query winner detail(betid, msisdn)
            //credit(transaction, profile_balance) and update win amount jpwinner

            $jpwinners = $model->getjpwinners($model->jackpot_event_id, $model->total_games_correct);
            
            $credit_result = $model->credit_jpwinners_accounts($jpwinners);
            Yii::$app->getSession()->setFlash('success', "Jackpot winner credit success");
            if($model->jackpot_winner_id){
                return $this->redirect(['view', 'id' => $model->jackpot_winner_id]);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model, 'jpmatch_model' => $jpmatch_model
            ]);
        }
    }

    /**
     * Updates an existing JackpotWinner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->jackpot_winner_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing JackpotWinner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JackpotWinner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JackpotWinner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = JackpotWinner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
