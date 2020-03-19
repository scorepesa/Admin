<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VirtualsOutbox */

$this->title = 'Create Virtuals Outbox';
$this->params['breadcrumbs'][] = ['label' => 'Virtuals Outboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-outbox-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
