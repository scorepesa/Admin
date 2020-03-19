<?php

namespace frontend\controllers;

use Yii;
use app\models\ProfileBonus;
use app\models\ProfileBalance;
use app\models\ProfileBonusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileBonusController implements the CRUD actions for ProfileBonus model.
 */
class ProfileBonusController extends Controller {

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
     * Lists all ProfileBonus models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProfileBonusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfileBonus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProfileBonus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

	$params = Yii::$app->request->queryParams;
        $id= $params['ProfileBonusSearch']['profile_id'];
        $model = new ProfileBonus();

        if (Yii::$app->request->post()) {
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            $model->load(Yii::$app->request->post());
            #$model->save();
            $pb_sql = "INSERT IGNORE INTO profile_balance (profile_id,balance,transaction_id,created,modified,bonus_balance) VALUES($model->profile_id,0,-1,now(),now(),$model->bonus_amount) ON DUPLICATE KEY UPDATE bonus_balance = bonus_balance + ".$model->bonus_amount;
            $bonus_tx  = "insert into profile_bonus(profile_bonus_id, profile_id, referred_msisdn, bonus_amount, status, expiry_date, date_created, updated, bet_on_status, created_by) values (null, $model->profile_id, $model->referred_msisdn, $model->bonus_amount, 'CLAIMED', now()+interval 48 hour, now(), now(), 0, '" .Yii::$app->user->identity->username ."') ";
            $connection->createCommand($bonus_tx)->execute();
            $connection->createCommand($pb_sql)->execute();
            $transaction->commit();
            Yii::$app->getSession()->setFlash('success', [
                'message' => 'Operation succeded.'
            ]);
            return $this->redirect(['index', 'ProfileBonusSearch[profile_id]' => $model->profile_id]);
        } else {
            return $this->render('create', [
                        'id'=>$id,
                        'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing ProfileBonus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $model = $this->findModel($id);
            $profile_balance = new ProfileBalance();

            if ($model->load(Yii::$app->request->post())) {
                //insert on duplicate update profile balance
                //award only if status CLAIMED
                if ($model->status != 'USED') {
                    /*$profile_bal = $profile_balance->findOne(array(
                        'profile_id' => $model->profile_id,
                    ));

                    if (!$profile_bal) {
                        //no profile bal create
                        $pb_sql = "INSERT IGNORE INTO profile_balance (profile_id,balance,transaction_id,created,modified,bonus_balance) VALUES($model->profile_id,0,-1,now(),now(),$model->bonus_amount)";
			$connection->createCommand($pb_sql)->execute();
                    } else {
                        //update profile bal
                        $pb_update_sql = "UPDATE profile_balance SET bonus_balance = (bonus_balance+$model->bonus_amount) WHERE profile_id = $model->profile_id LIMIT 1";
                        $connection->createCommand($pb_update_sql)->execute();
                    }

                    //save
                    $model->status = 'CLAIMED';
                    */

                    /*if ($model->save()):
                    $transaction->commit();*/
                    Yii::$app->getSession()->setFlash('success', [
                       'message' => 'Operation succeded. Not allowed.'
                    ]);
                    /*else:
                        $transaction->rollback();
                        Yii::$app->getSession()->setFlash('success', [
                            'message' => 'Operation succeded partially. Rolled back.'
                        ]);
                    endif;*/
                } elseif ($model->status == 'USED') {
			$model->status = "USED";
			$model->bet_on_status = 2;
			$model->save();
			$transaction->commit();
		}
                return $this->redirect(['view', 'id' => $model->profile_bonus_id]);
            } else {

                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } catch (Exception $exc) {
            $transaction->rollback();
            Yii::$app->getSession()->setFlash('error', [
                'message' => 'Operation failed. Error occured.'
            ]);
        }
    }

    /**
     * Deletes an existing ProfileBonus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
//        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProfileBonus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfileBonus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProfileBonus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
