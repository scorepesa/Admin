<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutrightOutcomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outright Outcomes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-outcome-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Outright Outcome', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'outcome_id',
            'parent_outright_id',
            'betradar_competitor_id',
            'odd_type',
            'special_bet_value',
            // 'outcome',
            // 'status',
            // 'created_by',
            // 'created',
            // 'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
