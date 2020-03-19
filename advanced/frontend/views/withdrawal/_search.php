<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WithdrawalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdrawal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'withdrawal_id') ?>

    <?= $form->field($model, 'inbox_id') ?>

    <?= $form->field($model, 'msisdn') ?>

    <?= $form->field($model, 'raw_text') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'reference') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'provider_reference') ?>

    <?php // echo $form->field($model, 'number_of_sends') ?>

    <?php // echo $form->field($model, 'charge') ?>

    <?php // echo $form->field($model, 'max_withdraw') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
