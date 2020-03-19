<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightCompetitor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outright-competitor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_outright_id')->textInput() ?>

    <?= $form->field($model, 'betradar_competitor_id')->textInput() ?>

    <?= $form->field($model, 'betradar_super_id')->textInput() ?>

    <?= $form->field($model, 'competitor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
