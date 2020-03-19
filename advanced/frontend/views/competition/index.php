<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompetitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Competitions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="competition-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Competition', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'competition_id',
            'competition_name',
            'betradar_competition_id',
            'category',
            'category_id',
            // 'status',
            // 'sport_id',
            // 'created_by',
            // 'created',
            // 'modified',
            // 'priority',
            // 'ussd_priority',
            // 'max_stake',
            // 'alias',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
