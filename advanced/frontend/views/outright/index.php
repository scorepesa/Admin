<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutrightSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outrights';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Outright', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'outright_id',
            'parent_outright_id',
            'event_name',
            'event_date',
            'event_end_date',
            // 'game_id',
            // 'competition_id',
            // 'status',
            // 'instance_id',
            // 'created_by',
            // 'created',
            // 'modified',
            // 'result',
            // 'completed',
            // 'priority',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
