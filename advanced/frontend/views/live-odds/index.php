<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LiveOddsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Live Odds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-odds-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Live Odds', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],
            //'live_odds_id',
            'parent_match_id',
            'match.home_team',
            'match.away_team',
            'match.start_time',
            'subtype',
            'key',
            'value',
            'match_time',
            'score',
            'bet_status',
            // 'created',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
