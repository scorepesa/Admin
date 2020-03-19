<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JackpotEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jackpot Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#">JP Events</a></li>
        <li><a href="<?php echo Url::to(['jackpot-type/index']) ?>">JP Types</a></li>
        <li><a href="<?php echo Url::to(['jackpot-match/index']) ?>">JP Matches</a></li>
        <!-- <li><a href="<?php echo Url::to(['jackpot-trx/index']) ?>">JP Transactions</a></li>
        <li><a href="<?php echo Url::to(['jackpot-bet/index']) ?>">JP Bets</a></li> -->
        <li><a href="<?php echo Url::to(['jackpot-winner/index']) ?>">JP Winners</a></li>
        <li><a href="<?php echo Url::to(['jackpot-event/jpbonus-index']) ?>">JP Bonus Award</a></li>
    </ul>
    <p>
        <?= Html::a('Create Jackpot Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'jackpot_event_id',
            'jackpot_type',
            'jackpot_name',
            'created_by',
            'status',
            'bet_amount',
            'total_games',
            'created',
            'requisite_wins',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
