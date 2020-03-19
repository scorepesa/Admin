<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\IncomingOddSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Incoming Odds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incoming-odd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Incoming Odd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'incoming_odd_id',
            'parent_match_id',
            'home_odd',
            'neutral_odd',
            'away_odd',
            // 'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
