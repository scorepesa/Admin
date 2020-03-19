<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TalksportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Talksports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talksport-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Talksport', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'talksport_id',
            'parent_match_id',
            'stream_url:url',
            'created',
            'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
