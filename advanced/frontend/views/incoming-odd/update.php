<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IncomingOdd */

$this->title = 'Update Incoming Odd: ' . $model->incoming_odd_id;
$this->params['breadcrumbs'][] = ['label' => 'Incoming Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->incoming_odd_id, 'url' => ['view', 'id' => $model->incoming_odd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incoming-odd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
