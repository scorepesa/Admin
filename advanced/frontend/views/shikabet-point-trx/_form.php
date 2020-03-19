<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPointTrx */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scorepesa-point-trx-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trx_id')->textInput() ?>

    <?= $form->field($model, 'points')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trx_type')->dropDownList([ 'CREDIT' => 'CREDIT', 'DEBIT' => 'DEBIT', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'REDEEM' => 'REDEEM', 'GAIN' => 'GAIN', 'TRANSFER' => 'TRANSFER', 'CANCELLED' => 'CANCELLED', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
