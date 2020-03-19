<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualMatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtual-match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_virtual_id')->textInput() ?>

    <?= $form->field($model, 'home_team')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'away_team')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'competition_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'instance_id')->textInput() ?>

    <?= $form->field($model, 'bet_closure')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ht_score')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ft_score')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'completed')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
