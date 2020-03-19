<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OddsChangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Odds Changes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odds-change-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Odds Change', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'odds_change_id',
            'parent_match_id:ntext',
            'subtype:ntext',
            'key:ntext',
            'value:ntext',
            // 'match_time:ntext',
            // 'score:ntext',
            // 'bet_status:ntext',
            // 'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
