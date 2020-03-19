<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VirtualsOutboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Virtuals Outboxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-outbox-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Virtuals Outbox', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'outbox_id',
            'shortcode',
            'network',
            'profile_id',
            'linkid',
            // 'date_created',
            // 'date_sent',
            // 'retry_status',
            // 'modified',
            // 'text:ntext',
            // 'msisdn',
            // 'sdp_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
