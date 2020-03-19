<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sport-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sport', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sport_id',
            'sport_name',
            'created_by',
            'created',
            'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
