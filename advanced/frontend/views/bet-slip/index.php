<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\DropDownActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BetSlipSearch */
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bet Slips';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="bet-bet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]);   ?>
   

    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'created',
            ['label' => 'Match', 'attribute' => 'betMatch'],
            'subtypeName',
            'sub_type_id',
            'parent_match_id',
            ['label' => 'GameID', 'attribute' => 'betGameId'],
        /*    [
                'class' => DropDownActionColumn::className(),
                'items' => [],
            ],*/
            'live_bet',
            'total_games',
            'odd_value',
            'bet_pick',
            'outcomeValue',
            'special_bet_value',
            'win',
            'status',
    ]]);
    ?>
    <?php Pjax::end(); ?></div>
