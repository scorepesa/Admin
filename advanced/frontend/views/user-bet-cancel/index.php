<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserBetCancelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cancelled Bets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bet-cancel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-info" href="<?php echo Url::to(['user-bet-cancel/manualcreate']) ?>">Manual Cancel Bet</a>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'bet_id',
            'status',
            'created_by',
            'created',
            'modified',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
