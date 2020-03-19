<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VirtualMatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Virtual Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtual-match-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Virtual Match', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'v_match_id',
            'parent_virtual_id',
            'home_team',
            'away_team',
            'start_time',
            // 'competition_id',
            // 'status',
            // 'instance_id',
            // 'bet_closure',
            // 'created_by',
            // 'created',
            // 'modified',
            // 'result',
            // 'ht_score',
            // 'ft_score',
            // 'completed',
            // 'priority',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
