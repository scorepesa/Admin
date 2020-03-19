<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsOutbox */

$this->title = 'Update Virtuals Outbox: ' . $model->outbox_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtuals Outboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->outbox_id, 'url' => ['view', 'id' => $model->outbox_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="virtuals-outbox-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
