<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotTrx */

$this->title = 'Update Jackpot Trx: ' . $model->jackpot_trx_id;
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Trxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jackpot_trx_id, 'url' => ['view', 'id' => $model->jackpot_trx_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jackpot-trx-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form3', [
        'model' => $model,
    ]) ?>

</div>
