<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LiveOdds */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="live-odds-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtype')->textInput() ?>
    <?= $form->field($model, 'key')->textInput() ?>
    <?= $form->field($model, 'value')->textInput() ?>
    <?= $form->field($model, 'match_time')->textInput() ?>
    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'bet_status')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
