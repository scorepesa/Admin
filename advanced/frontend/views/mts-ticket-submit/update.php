<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MtsTicketSubmit */

$this->title = 'Update Mts Ticket Submit: ' . $model->mts_ticket_submit_id;
$this->params['breadcrumbs'][] = ['label' => 'Mts Ticket Submits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mts_ticket_submit_id, 'url' => ['view', 'id' => $model->mts_ticket_submit_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mts-ticket-submit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
