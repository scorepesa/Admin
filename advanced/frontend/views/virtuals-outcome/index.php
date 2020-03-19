<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VirtualsOutcomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Virtuals Outcomes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-outcome-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Virtuals Outcome', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'v_match_result_id',
            'sub_type_id',
            'parent_virtual_id',
            'special_bet_value',
            //'live_bet',
             'created_by',
             'created',
             'modified',
             'status',
            // 'approved_by',
            // 'approved_status',
            // 'date_approved',
            // 'winning_outcome',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
