<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BleagueEventOdd */

$this->title = 'Update Bleague Event Odd: ' . $model->event_odd_id;
$this->params['breadcrumbs'][] = ['label' => 'Bleague Event Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->event_odd_id, 'url' => ['view', 'id' => $model->event_odd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bleague-event-odd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
