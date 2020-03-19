<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScorepesaPointSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scorepesa Points';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scorepesa-point-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'scorepesa_point_id',
            'profile_id',
            'points',
            'redeemed_amount',
            'created_by',
            // 'status',
            // 'created',
            // 'modified',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
