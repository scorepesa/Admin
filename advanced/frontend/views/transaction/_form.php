<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'profile_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'iscredit')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'running_balance')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'created')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'modified')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
