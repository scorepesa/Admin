<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutcomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manual Match Resulting';
$this->params['breadcrumbs'][] = $this->title;
?>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#resulting">Post Results</a></li>
    <li><a href="<?php echo Url::to(['outcome/approveoutcome']) ?>">Approve Results</a></li>
</ul>

<div class="outcome-index" id="resulting">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);         ?>

    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        'created',
        ['label' => 'Start Time', 'value' => function($data) {
                return $data->parentMatch->start_time;
            }],
        ['label' => 'GameID', 'attribute' => 'gameId'],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'htFtScore',
            'editableOptions' => function ($model, $key, $index) {
                return [
                    'header' => ($model->sub_type_id == 10) ? '3Way Result' : "Winning Outcome",
                    'size' => 'md',
                    'formOptions' => $model->getMatchSport($model->parent_match_id) == 29 ? ['action' => ['/outcome/icehockeyresulting']] : ['action' => ['/outcome/custresulting']], // point to the new action        
                    'afterInput' => function ($form, $widget) use ($model, $index) {
                $haystack = array(10, 56, 60, 43, 414, 570, 575, 577, 578, 268, 46, 2, 1, 332, 49, 203, 207, 202, 262, 329, 44, 385, 323, 381, 322, 55, 269, 45, 402, 384, 383, 328, 267, 48, 258, 270, 321, 320, 317, 47, 352, 353, 336, 259, 271, 377, 352, 353, 381, 314, 212, 210);
                $custom_stack = array(43);
                $sport = $model->getMatchSport($model->parent_match_id);

                if (in_array($model->sub_type_id, $haystack) && $sport == 29) {
                    $cust_form = '_icehockey_resulting_form';
                    if (in_array($model->sub_type_id, $custom_stack)):
                        $cust_form = '_resulting_cust_form';
                        return $this->render($cust_form, ['model' => $model]);
                    endif;
                    return $this->render($cust_form, ['model' => $model]);
                } elseif (!in_array($model->sub_type_id, $haystack)) {
                    $cust_form = '_resulting_cust_form';
                    return $this->render($cust_form, ['model' => $model]);
                } else {
                    $default_form = '_resulting_form';
                    return $this->render($default_form, ['model' => $model]);
                }
            },
                ];
            }
                ],
                [
                    'label' => 'Market',
                    'attribute' => 'resultingSubtypeName',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'width' => '150px',
                    'noWrap' => true,
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
//                    'filterType' => GridView::FILTER_SORTABLE
                ],
                'outcomeValue',
                'home_team',
                'away_team',
            ];

            $layout = <<< HTML
<div class="panel panel-primary">
 <div class="panel-heading"> 
   <div class="pull-right">
    {summary}
   </div>
   <div class="kv-panel-pager">
    {pager}
   </div> 
</div> 
 
   {items}
</div>

HTML;
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns,
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'toolbar' => [
                    ['content' =>
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['resulting'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                    ],
                    '{export}',
                    '{toggleData}'
                ],
                'layout' => $layout,
                'pjax' => true,
                'bordered' => true,
                'striped' => false,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,
//                'floatHeader' => true,
//                'floatHeaderOptions' => ['scrollingTop' => 10],
                'showPageSummary' => false,
                'panel' => false
//                'panel' => [
//                    'type' => GridView::TYPE_PRIMARY
//                ]
            ]);
            ?>
</div>
