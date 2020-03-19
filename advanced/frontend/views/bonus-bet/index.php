<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BonusBetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bonus Bets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonus-bet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Bonus Bet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
         //   ['class' => 'yii\grid\SerialColumn'],
            'bonus_bet_id',
            'bet_id',
            'bet_amount',
            'possible_win',
            'profile_bonus_id',
            'won',
            'status',
            'ratio',
            'created_by',
            'created',
            // 'modified',
    //        ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
