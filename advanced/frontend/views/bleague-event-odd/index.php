<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BleagueEventOddSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Active Bleague Event Odds';
$this->params['breadcrumbs'][] = $this->title;
?>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#active">Active</a></li>
    <li><a data-toggle="tab" href="#processed">Processed</a></li>
</ul>


<div class="tab-content">

    <div id="active" class="tab-pane fade in active">
        <div class="bleague-event-odd-index">

            <h1><?php // Html::encode($this->title) ?>Active Event Odds</h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Bleague Event Odd', ['create'], ['class' => 'btn btn-success']) ?>
            </p>


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'event_odd_id',
                    //'parent_match_id',
                    ['label' => 'Home Team', 'attribute' => 'homeTeam'],
                    ['label' => 'Away Team', 'attribute' => 'awayTeam'],
                    ['label' => 'Sub Type ID', 'attribute' => 'name'],
                    //'sub_type_id',
                    //'max_bet',
                    'odd_key',
                    'odd_value',
                    'special_bet_value',
                    [   //'label' => 'Resul',
                        'format' => 'raw',
                        'value' => function($model, $key, $index, $column) {
                                return Html::a(
                                    'YES',
                                    Url::to(['bleague-event-odd/result', 'winning_outcome' => 'YES', 'sub_type_id' => $model->sub_type_id, 'parent_match_id' => $model->parent_match_id, 'created_by' => Yii::$app->user->identity->username, 'event_odd_id' => $model->event_odd_id, 'special_bet_value' => $model->special_bet_value]), 
                                    [
                                        'id'=>'grid-custom-button',
                                        'data-pjax'=>true,
                                        'action'=>Url::to(['bleague-event-odd/result', 'winning_outcome' => 'YES', 'sub_type_id' => $model->sub_type_id, 'parent_match_id' => $model->parent_match_id, 'created_by' => Yii::$app->user->identity->username, 'event_odd_id' => $model->event_odd_id, 'special_bet_value' => $model->special_bet_value]),
                                        'class'=>['btn btn-xs btn-success'],
                                        'data-toggle' => 'confirmation',
                                    ]
                                );
                        }
                    ],

                    [   //'label' => 'ting',
                        'format' => 'raw',
                        'value' => function($model, $key, $index, $column) {
                                return Html::a(
                                    'NO',
                                    Url::to(['bleague-event-odd/result', 'winning_outcome' => 'NO', 'sub_type_id' => $model->sub_type_id, 'parent_match_id' => $model->parent_match_id, 'created_by' => Yii::$app->user->identity->username, 'event_odd_id' => $model->event_odd_id, 'special_bet_value' => $model->special_bet_value]), 
                                    [
                                        'id'=>'grid-custom-button',
                                        'data-pjax'=>true,
                                        'action'=>Url::to(['bleague-event-odd/result', 'winning_outcome' => 'NO', 'sub_type_id' => $model->sub_type_id, 'parent_match_id' => $model->parent_match_id, 'created_by' => Yii::$app->user->identity->username, 'event_odd_id' => $model->event_odd_id, 'special_bet_value' => $model->special_bet_value]),
                                        'class'=>['btn btn-xs btn-danger'],
                                        'data-toggle' => 'confirmation',
                                    ]
                                );
                        }
                    ],

                    [   //'label' => 'ting',
                        'format' => 'raw',
                        'value' => function($model, $key, $index, $column) {
                                return Html::a(
                                    'VOID',
                                    Url::to(['bleague-event-odd/result', 'winning_outcome' => '-1', 'sub_type_id' => $model->sub_type_id, 'parent_match_id' => $model->parent_match_id, 'created_by' => Yii::$app->user->identity->username, 'event_odd_id' => $model->event_odd_id, 'special_bet_value' => $model->special_bet_value]), 
                                    [
                                        'id'=>'grid-custom-button',
                                        'data-pjax'=>true,
                                        'action'=>Url::to(['bleague-event-odd/result', 'winning_outcome' => '-1', 'sub_type_id' => $model->sub_type_id, 'parent_match_id' => $model->parent_match_id, 'created_by' => Yii::$app->user->identity->username, 'event_odd_id' => $model->event_odd_id, 'special_bet_value' => $model->special_bet_value]),
                                        'class'=>['btn btn-xs btn-warning'],
                                        'data-toggle' => 'confirmation',
                                    ]
                                );
                        }
                    ],
                    'created_by',
                    'created',
                    //'modified',
                    // 'odd_alias',
                    // 'status',


                    ['class' => 'yii\grid\ActionColumn'],
                ],

            ]);?>
        </div>
    </div>

    <div id="processed" class="tab-pane fade in">
        <div class="bleague-event-odd-index">

            <h1><?php // Html::encode($this->title) ?>Processed Event Odds</h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Bleague Event Odd', ['create'], ['class' => 'btn btn-success']) ?>
            </p>


            <?= GridView::widget([
                'dataProvider' => $dataProvider1,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'event_odd_id',
                    //'parent_match_id',
                    ['label' => 'Home Team', 'attribute' => 'homeTeam'],
                    ['label' => 'Away Team', 'attribute' => 'awayTeam'],
                    ['label' => 'Sub Type ID', 'attribute' => 'name'],
                    //'sub_type_id',
                    //'max_bet',
                    'odd_key',
                    'odd_value',
                    'special_bet_value',
                    'created_by',
                    'approved_by',
                    'winning_outcome',
                    'created',
                    //'modified',
                    // 'odd_alias',
                    // 'status',


                    ['class' => 'yii\grid\ActionColumn'],
                ],

            ]);?>
        </div>
    </div>

</div>

