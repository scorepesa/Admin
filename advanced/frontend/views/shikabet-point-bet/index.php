<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScorepesaPointBetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scorepesa Point Bets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scorepesa-point-bet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Scorepesa Point Bet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'scorepesa_point_bet_id',
            'bet_id',
            'scorepesa_point_trx_id',
            'points',
            'amount',
            // 'created_by',
            // 'created',
            // 'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
