<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsOutcome */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtuals-outcome-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sub_type_id')->textInput() ?>

    <?= $form->field($model, 'parent_match_id')->textInput() ?>

    <?= $form->field($model, 'special_bet_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'live_bet')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'approved_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approved_status')->textInput() ?>

    <?= $form->field($model, 'date_approved')->textInput() ?>

    <?= $form->field($model, 'winning_outcome')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
