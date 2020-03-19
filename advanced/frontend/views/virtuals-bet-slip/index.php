<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VirtualsBetSlipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Virtuals Bet Slips';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-bet-slip-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Virtuals Bet Slip', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bet_slip_id',
            'parent_match_id',
            'bet_id',
            'bet_pick',
            'special_bet_value',
            // 'total_games',
            // 'odd_value',
            // 'win',
            // 'live_bet',
            // 'created',
            // 'modified',
            // 'status',
            // 'sub_type_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
