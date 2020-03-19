<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inbox';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="bet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
<!--    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#inbox">Inbox</a></li>
        <li><a href="<?php //echo Url::to(['outbox/index']) ?>">Outbox</a></li>
    </ul>-->

    <?php
    $gridColumns = [
//        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'inbox_id',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        [
            'attribute' => 'shortcode',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        [
            'attribute' => 'msisdn',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
//        [
//            'label' => 'Outbox',
//            'class' => 'kartik\grid\ExpandRowColumn',
//            'width' => '50px',
//            'value' => function ($model, $key, $index, $column) {
//                return GridView::ROW_COLLAPSED;
//            },
//            'detailUrl' => yii\helpers\Url::to(['outbox/index']),
//            'headerOptions' => ['class' => 'kartik-sheet-style'],
//            'expandOneOnly' => true,
//            'allowBatchToggle' => false,
//            'expandTitle' => "System Response"
//        ],
        [
            'label' => 'outbox',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::tag("a", "outbox", ['href' => yii\helpers\Url::to(['outbox/index']) . '&OutboxSearch[msisdn]=' . $data->msisdn]);
            },
                ],
                [
                    'attribute' => 'message',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'width' => '150px',
                    'noWrap' => false
                ],
                [
                    'attribute' => 'created',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'width' => '150px',
                    'noWrap' => true
                ]
            ];


            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns,
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'beforeHeader' => [
                    [
                        'columns' => [
                            ['content' => 'Incomming sms requests', 'options' => ['colspan' => 7, 'class' => 'text-center warning']],
                        ],
                        'options' => ['class' => 'skip-export'] // remove this row from export
                    ]
                ],
                'toolbar' => [
                    ['content' =>
//                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                    ],
                    '{export}',
                    '{toggleData}'
                ],
                'pjax' => true,
                'bordered' => true,
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,
                'floatHeader' => true,
                'floatHeaderOptions' => ['scrollingTop' => 10],
                'showPageSummary' => false,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY
                ],
            ]);
            ?>
</div>
