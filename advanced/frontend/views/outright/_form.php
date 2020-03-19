<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Outright */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outright-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_outright_id')->textInput() ?>

    <?= $form->field($model, 'event_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_date')->textInput() ?>

    <?= $form->field($model, 'event_end_date')->textInput() ?>

    <?= $form->field($model, 'game_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'competition_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'instance_id')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'completed')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
