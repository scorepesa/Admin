<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

//use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outbox';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outbox-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]);  ?>
    <?php
    $gridColumns = [
        /*[
            'attribute' => 'outbox_id',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],*/
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
        [
            'attribute' => 'date_created',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => true
        ],
        [
            'attribute' => 'text',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '15px',
//            'noWrap' => true
        ],
        ['attribute'=>'sdp_status', 'label'=>'Delivery Status']
//            ['class' => 'yii\grid\ActionColumn'],
    ];
    // Control your pjax options
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'Outgoing sms responses', 'options' => ['colspan' => 5, 'class' => 'text-center warning']],
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
        #'panel' => [
        #    'type' => GridView::TYPE_PRIMARY
        #],
    ]);
    ?>
</div>
