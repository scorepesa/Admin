<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightOutcome */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outright-outcome-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_outright_id')->textInput() ?>

    <?= $form->field($model, 'betradar_competitor_id')->textInput() ?>

    <?= $form->field($model, 'odd_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'special_bet_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outcome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
