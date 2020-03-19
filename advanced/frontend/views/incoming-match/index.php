<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IncomingMatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Incoming Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incoming-match-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?= Html::beginForm(['fixture/index'], 'post', ['id' => "filter-form"]); ?>

    <?= Html::button("Apply to Selected Records", ["class" => ["form-control", "btn btn-success"], "style" => "margin-left:5px;float:right; width:200px", "onClick" => "submitHandler()"])
    ?>
    <?=
    Html::dropDownList('action', '', ['' => 'Select Action ',
        'movetoactive' => 'Move to Active Matches',
        'discard' => 'Discard'], ['class' => ['dropdown', 'form-control'],
        'style' => 'width:200px; float:right;margin-bottom:10px'])
    ?>


    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
//            'incoming_match_id',
            'parent_match_id',
//            'sport_name',
            'competition_name',
            'competition_category',
            'start_time',
            // 'end_time',
            'home_team',
            'away_team',
            'home_odd',
            'neutral_odd',
            'away_odd',
            // 'created',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
<?= Html::endForm(); ?>

<?php
$link = yii\helpers\Url::to(['fixture/index']);
$submitJS = '
    var submitHandler = function(){
    var data = $("#filter-form").serialize();
    $.post("' . $link . '", data,
        function(res){
        console.log(res);
        });
};';
?>
<?= Html::script($submitJS); ?>
