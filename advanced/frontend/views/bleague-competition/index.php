<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BleagueCompetitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bleague Competitions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bleague-competition-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bleague Competition', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'competition_id',
            'competition_name',
            'category',
            'status',
            'sport_id',
            'priority',
            'created_by',
            'created',
            // 'modified',
            // 'max_stake',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
