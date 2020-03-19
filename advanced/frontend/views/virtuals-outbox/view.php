<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsOutbox */

$this->title = $model->outbox_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtuals Outboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-outbox-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->outbox_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->outbox_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'outbox_id',
            'shortcode',
            'network',
            'profile_id',
            'linkid',
            'date_created',
            'date_sent',
            'retry_status',
            'modified',
            'text:ntext',
            'msisdn',
            'sdp_id',
        ],
    ]) ?>

</div>
