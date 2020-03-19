<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SevenAggregatorRequest */

$this->title = 'Update Seven Aggregator Request: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Seven Aggregator Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="seven-aggregator-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
