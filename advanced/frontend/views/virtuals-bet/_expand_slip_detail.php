<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BetSlipSearch */
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="bet-bet-index">

    <?php
    $gridcols = [
        ['class' => 'yii\grid\SerialColumn'],
        ['label' => 'Match',
            'attribute' => 'match',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true],
        [
            'attribute' => 'subtypeName',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        [
            'attribute' => 'sub_type_id',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        [
            'attribute' => 'parent_match_id',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
/*        [
            'attribute' => 'live_bet',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        ['label' => 'GameID',
            'attribute' => 'gameId',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],*/
        ['attribute' => 'odd_value',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        ['attribute' => 'bet_pick',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        ['attribute' => 'outcomeValue',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        ['attribute' => 'special_bet_value',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        [
            'attribute' => 'win',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        [
            'attribute' => 'status',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
    ];

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}",
        'columns' => $gridcols,
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'Slip Detail', 'options' => ['colspan' => 15, 'class' => 'text-center success']],
                ],
            ]
        ],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => 10],
        'showPageSummary' => false,
        'toolbar' => false,
        'panel' => [
            'heading' => false,
            'bootstrap' => true,
            'type' => GridView::TYPE_PRIMARY,
            'footer' => false
        ],
    ]);
    ?>
</div>
