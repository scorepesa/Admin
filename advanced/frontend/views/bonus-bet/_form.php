<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BonusBet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bonus-bet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bet_id')->textInput() ?>

    <?= $form->field($model, 'bet_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'possible_win')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_bonus_id')->textInput() ?>

    <?= $form->field($model, 'won')->textInput() ?>

    <?= $form->field($model, 'ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
