<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MpesaTransaction */

$this->title = 'Update Mpesa Transaction: ' . $model->mpesa_transaction_id;
$this->params['breadcrumbs'][] = ['label' => 'Mpesa Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mpesa_transaction_id, 'url' => ['view', 'id' => $model->mpesa_transaction_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mpesa-transaction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
