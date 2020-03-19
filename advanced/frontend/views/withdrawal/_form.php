<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Withdrawal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdrawal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'msisdn')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'raw_text')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    <?= $form->field($model, 'created_by')->hiddenInput(['maxlength' => true, 'readonly' => true, 'value' => Yii::$app->user->identity->username])->label(false) ?>

    <?= $form->field($model, 'created')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([ 'PROCESSING' => 'PROCESSING', 'QUEUED' => 'QUEUED', 'SUCCESS' => 'SUCCESS', 'FAILED' => 'FAILED',], ['prompt' => '', 'readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Retry Withdraw', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
