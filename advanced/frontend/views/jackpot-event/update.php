<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotEvent */

$this->title = 'Update Jackpot Event: ' . $model->jackpot_event_id;
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jackpot_event_id, 'url' => ['view', 'id' => $model->jackpot_event_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jackpot-event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
