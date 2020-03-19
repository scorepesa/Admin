<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MtsTicketSubmit */

$this->title = $model->mts_ticket_submit_id;
$this->params['breadcrumbs'][] = ['label' => 'Mts Ticket Submits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mts-ticket-submit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->mts_ticket_submit_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->mts_ticket_submit_id], [
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
            'mts_ticket_submit_id',
            'bet_id',
            'mts_ticket',
            'status',
            'response',
            'message:ntext',
            'created',
            'modified',
        ],
    ]) ?>

</div>
