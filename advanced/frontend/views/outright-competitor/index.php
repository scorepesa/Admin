<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutrightCompetitorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outright Competitors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-competitor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Outright Competitor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'competitor_id',
            'parent_outright_id',
            'betradar_competitor_id',
            'betradar_super_id',
            'competitor_name',
            // 'status',
            // 'priority',
            // 'created_by',
            // 'created',
            // 'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
