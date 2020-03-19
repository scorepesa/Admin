<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShopDepositsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-deposits-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transaction_id') ?>

    <?= $form->field($model, 'msisdn') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'network') ?>

    <?php // echo $form->field($model, 'depositor') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'approved_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
