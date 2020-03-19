<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutrightOddSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outright Odds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-odd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Outright Odd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'odd_id',
            'parent_outright_id',
            'betradar_competitor_id',
            'odd_type',
            'odd_value',
            // 'special_bet_value',
            // 'status',
            // 'created_by',
            // 'created',
            // 'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
