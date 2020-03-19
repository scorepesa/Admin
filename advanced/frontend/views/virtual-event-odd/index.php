<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VirtualEventOddSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Virtual Event Odds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtual-event-odd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Virtual Event Odd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'v_event_odd_id',
            'parent_virtual_id',
            'sub_type_id',
            'max_bet',
            'created',
            // 'modified',
            // 'odd_key',
            // 'odd_value',
            // 'odd_alias',
            // 'special_bet_value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
