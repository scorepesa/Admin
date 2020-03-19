<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BetSlip */

$this->title = 'Update Bet Slip: ' . $model->bet_slip_id;
$this->params['breadcrumbs'][] = ['label' => 'Bet Slips', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bet_slip_id, 'url' => ['view', 'id' => $model->bet_slip_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bet-slip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
