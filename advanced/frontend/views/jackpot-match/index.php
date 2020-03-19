<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JackpotMatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jackpot Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-match-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jackpot Match', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'jackpot_match_id',
            'jackpot_event_id',
            'parent_match_id',
            'status',
            'created_by',
            'created',
            'game_order',
            // 'modified',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'toolbar' => [
            [
                'content' =>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                    'type' => 'button',
                    'title' => "Add match",
                    'class' => 'btn btn-success'
                ]) . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                    'class' => 'btn btn-default',
                    'title' => "Reset"
                ]),
            ],
            '{export}',
            '{toggleData}'
        ]
    ]);
    ?>
</div>

