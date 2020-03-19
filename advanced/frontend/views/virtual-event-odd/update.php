<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualEventOdd */

$this->title = 'Update Virtual Event Odd: ' . $model->v_event_odd_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtual Event Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->v_event_odd_id, 'url' => ['view', 'id' => $model->v_event_odd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="virtual-event-odd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
