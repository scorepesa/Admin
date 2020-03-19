<?php

namespace frontend\controllers;

use Yii;
use app\models\JpbonusAward;
use app\models\JpbonusAwardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JpbonusAwardController implements the CRUD actions for JpbonusAward model.
 */
class JpbonusAwardController extends Controller
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
     * Lists all JpbonusAward models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JpbonusAwardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JpbonusAward model.
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
     * Creates a new JpbonusAward model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JpbonusAward();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing JpbonusAward model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing JpbonusAward model.
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
     * Finds the JpbonusAward model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JpbonusAward the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JpbonusAward::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAwardjackpotbonus() {
        $model = new JpbonusAward();

        if(Yii::$app->request->post()) {

            $model->load(Yii::$app->request->post());
            
            $result = $model->awardJackpotBonus($model->jackpot_event_id,  $model->total_games_correct[0], $model->jackpot_bonus, $model->scorepesa_points_bonus, $model->created_by);

            if($result) {
                $msg = "Jackpot Bonus Awarded Successfully.";
                $error = 'success';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect(['index']);

            } else {
                return $this->redirect('index');
            }
            

        } else {
        return $this->render('award_jackpot_bonus', [
                'model' => $model,
            ]);
        }
    }

    public function actionApprovebonusaward($id,$approvedBy) {
        // Some code here
        $model = new JpbonusAward();
        $result = $model->approveBonusAward($id,$approvedBy);

        if($result) {
                $msg = "Jackpot Bonus Approved Successfully.";
                $error = 'success';

                Yii::$app->getSession()->setFlash($error, $msg);

                return $this->redirect(['index']);

        } else {
            return $this->redirect('index');
        }

    }

}
