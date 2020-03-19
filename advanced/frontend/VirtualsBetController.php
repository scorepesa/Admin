<?php

namespace frontend\controllers;

use Yii;
use app\models\VirtualsBet;
use app\models\VirtualsBetSlip;
use app\models\VirtualsBetSlipSearch;
use app\models\VirtualsBetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VirtualsBetController implements the CRUD actions for VirtualsBet model.
 */
class VirtualsBetController extends Controller
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
     * Lists all VirtualsBet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VirtualsBetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VirtualsBet model.
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
     * Creates a new VirtualsBet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VirtualsBet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bet_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VirtualsBet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bet_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing VirtualsBet model.
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
     * Finds the VirtualsBet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VirtualsBet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VirtualsBet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionSlipdetail() {
        if (isset($_POST['expandRowKey'])) {
            $searchModel = new VirtualsBetSlip();
            $query = $searchModel->find()->where(["bet_id" => $_POST['expandRowKey']]);

            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->renderPartial('_expand_slip_detail', ['model' => $searchModel,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider]);
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }

}
