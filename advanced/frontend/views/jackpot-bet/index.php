<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JackpotBetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jackpot Bets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-bet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'jackpot_bet_id',
            'bet_id',
            'jackpot_event_id',
            'status',
            'created',
            // 'modified',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
