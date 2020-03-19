<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SevenAggregatorRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seven Aggregator Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seven-aggregator-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'amount',
            'request_name',
            'amount_small',
            'currency',
            'user',
            'payment_strategy',
            'transactionType',
            'payment_id',
            'transaction_id',
            'source_id',
            'reference_id',
            'tp_token:ntext',
            'ticket_info:ntext',
            'security_hash',
            'club_uuid',
            'status',
            'aggregator_status',
            'created_by',
            'date_created',
            'date_modified',
        ],
    ]) ?>

</div>
