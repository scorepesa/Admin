<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VirtualsBetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Virtuals Bets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-bet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
            $gridColumns = [
                [
                    'attribute' => 'created',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'filterType' => GridView::FILTER_DATETIME
                ],
/*                [
                    'label' => 'BetType',
                    'attribute' => 'reference',
                    'format' => 'raw',
                    'width' => '150px',
                    'noWrap' => true,
                ],*/
                [
                    'attribute' => 'bet_id',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'width' => '150px',
                    'noWrap' => true,
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                ],
                [
                    'label' => 'MSISDN', 'attribute' => 'profileName',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'width' => '150px',
                    'noWrap' => true,
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                ],
                [
                    'attribute' => 'total_odd',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'width' => '150px',
                    'noWrap' => true,
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
//                    'filterType' => GridView::FILTER_SORTABLE
                ],
                [
                    'attribute' => 'Slip',
                    'label' => 'Slip',
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detailUrl' => yii\helpers\Url::to(['virtuals-bet/slipdetail']),
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                    'expandOneOnly' => true,
                    'allowBatchToggle' => false,
                    'expandTitle' => "Bet Slip Detail",
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                ],
                [
                    'attribute' => 'bet_amount',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'width' => '150px',
                    'noWrap' => true,
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
//                    'filterType' => GridView::FILTER_SELECT2
                ],
                [
                    'attribute' => 'possible_win',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'width' => '150px',
                    'noWrap' => true,
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                ],
                /*[
                    'class' => 'kartik\grid\EditableColumn',
                    'label' => '',
                    'attribute' => 'status',
                    'editableOptions' => function ($model, $key, $index) {
                        return [
                            'name' => 'win',
                            'value' => 0,
                            'asPopover' => true,
                            'header' => 'status',
                            'size' => 'sm',
                            'formOptions' => ['action' => ['/bet/update', 'id' => $model->bet_id]],
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                            'format' => 'button',
                            'editableValueOptions' => ['class' => 'well well-sm'],
                            'data' => [1 => 'Placed', 2 => 'Approved', 3 => 'Lost', 5 => 'Won', 7 => 'Wait approve', 9 => 'Jackpot', 24 => 'Cancelled'],
                            'options' => ['class' => 'form-control', 'prompt' => 'Select status...'],
                            'displayValueConfig' => [
                                '1' => '<i class="glyphicon glyphicon-thumbs-up"></i>Placed',
                                '7' => '<i class="glyphicon glyphicon-lock"></i>Wait Approve',
                                '2' => '<i class="glyphicon glyphicon-flag"></i>Approved',
                                '24' => '<i class="glyphicon glyphicon-ban-circle"></i> Cancelled',
                                '5' => '<i class="glyphicon glyphicon-ok"></i> Won',
                                '9' => '<i class="glyphicon glyphicon-king"></i> Jackpot',
                                '3' => '<i class="glyphicon glyphicon-remove"></i> Lost',
                            ],
                        ];
                    },
                            'headerOptions' => ['class' => 'kartik-sheet-style'],
                        ],*/
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
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns,
                        //'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                        'beforeHeader' => [
                            [
                                'columns' => [
                                    ['content' => 'Bet Identification', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                                    ['content' => 'Bet Extra details', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                                    ['content' => 'Bet Actions', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                ],
                                'options' => ['class' => 'skip-export'] // remove this row from export
                            ]
                        ],
                        'toolbar' => [
                           // ['content' =>
//                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
                             //   Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                         //   ],
                            '{export}',
                            '{toggleData}'
                        ],
                        'pjax' => true,
                        'bordered' => true,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'hover' => true,
                        'floatHeader' => false,
                        //'floatHeaderOptions' => ['scrollingTop' => 10],
                        'showPageSummary' => false,
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY
                        ],
                    ]);

    ?>
</div>
