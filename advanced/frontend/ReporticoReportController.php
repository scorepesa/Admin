<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\db\Query;

/**
 * ReporticoController implements embeds reportico reports for reportico module.
 */
class ReporticoReportController extends Controller {

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
     * Lists all AccountFreeze models.
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Render online reporting tool
     * 
     */
    public function actionVirtuals() {
        return $this->render('virtuals');
    }

    public function actionAirtelAudit() {
        return $this->render('airtel_audit');
    }

    public function actionUserbilling() {
        $model = new \app\models\Profile();
        $searchModel = new \app\models\CustomProfileSearch();
        $dataProvider = $model->userBillingReport();
        return $this->render('userbilling', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'searchModel' => $searchModel]);
    }

    public function actionDailysummary() {
        $model = new \app\models\Transaction();
        $dataProvider = $model->fetchDailySummary();
        $searchModel = new \app\models\ProfileSearch();
        return $this->render('dailysummary', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'searchModel' => $searchModel]);
    }

}
