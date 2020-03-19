<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MatchBetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Active Event Odds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-odd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Event Odd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'match.parent_match_id',
            'sub_type_id',
            'max_bet',
            'odd_key',
            'odd_value',
            'odd_alias',
            'created',
            'modified',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
