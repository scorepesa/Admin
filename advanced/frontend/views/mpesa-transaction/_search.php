<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MpesaTransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpesa-transaction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'mpesa_transaction_id') ?>

    <?= $form->field($model, 'msisdn') ?>

    <?= $form->field($model, 'transaction_time') ?>

    <?= $form->field($model, 'message') ?>

    <?= $form->field($model, 'account_no') ?>

    <?php // echo $form->field($model, 'mpesa_code') ?>

    <?php // echo $form->field($model, 'mpesa_amt') ?>

    <?php // echo $form->field($model, 'mpesa_sender') ?>

    <?php // echo $form->field($model, 'business_number') ?>

    <?php // echo $form->field($model, 'enc_params') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
