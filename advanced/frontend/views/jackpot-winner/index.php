<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JackpotWinnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jackpot Winners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-winner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div id="message">
          <?= Yii::$app->session->getFlash('success');?>
      </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Credit Winners', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'jackpot_winner_id',
            'bet_id',
            'msisdn',
            'win_amount',
            'jackpotEvent.jackpot_name',
            'jackpotEvent.total_games',
            'total_games_correct',
        // 'created_by',
        // 'status',
        // 'created',
        // 'modified',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
