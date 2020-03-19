<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LiveMatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Live Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-match-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Live Match', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'match_id',
            'parent_match_id',
            'home_team',
            'away_team',
            'start_time',
             'game_id',
             'competition_id',
             'status',
             ['label' => 'Competition', 'attribute' => 'competitionName'],
            // 'instance_id',
            // 'bet_closure',
             'created_by',
             'created',
             'modified',
            // 'result',
            // 'ht_score',
            // 'ft_score',
            // 'completed',
             'priority',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
