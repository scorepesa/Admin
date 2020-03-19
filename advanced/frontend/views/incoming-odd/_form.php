<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IncomingOdd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incoming-odd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'home_odd')->textInput() ?>

    <?= $form->field($model, 'neutral_odd')->textInput() ?>

    <?= $form->field($model, 'away_odd')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
