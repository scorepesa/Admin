<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileBonus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-bonus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'profile_id')->textInput() ?>

    <?= $form->field($model, 'referred_msisdn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bonus_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'NEW' => 'NEW', 'CLAIMED' => 'CLAIMED', 'EXPIRED' => 'EXPIRED', 'CANCELLED' => 'CANCELLED', 'USED' => 'USED',], ['prompt' => '']) ?>

    <?= $form->field($model, 'expiry_date')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>
    <?= $form->field($model, 'bet_on_status')->dropDownList([0 => 'NOT BET ON', 1 => 'NOT BET ON', 2 => 'BET ON', 'NULL' => 'NOT BET ON'], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
