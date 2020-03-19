<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BleagueMatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bleague Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bleague-match-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Bleague Matches', ['addmatches'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-success" href="<?php echo Url::to(['odd-type/addcustommarket']) ?>">Bleague Custom Market</a>
        <a class="btn btn-success" href="<?php echo Url::to(['bleague-event-odd/index']) ?>">Bleague Event Odds</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'match_id',
            'home_team',
            'away_team',
            'start_time',
            'game_id',
            // 'status',
            // 'bet_closure',
            // 'created_by',
            // 'created',
            // 'modified',
            // 'result',
            // 'ht_score',
            // 'ft_score',
            // 'completed',
            'priority',
            'parent_match_id',
            //'competition_id',
            ['label' => 'Competition', 'attribute' => 'competitionName'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
