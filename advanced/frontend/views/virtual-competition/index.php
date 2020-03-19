<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VirtualCompetitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Virtual Competitions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtual-competition-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Virtual Competition', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'v_competition_id',
            'competition_name',
            'category',
            'status',
            'category_id',
            // 'sport_id',
            // 'created_by',
            // 'created',
            // 'modified',
            // 'priority',
            // 'max_stake',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
