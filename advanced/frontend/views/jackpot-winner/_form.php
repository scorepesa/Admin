<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotWinner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-winner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'win_amount')->textInput() ?>

    <?= $form->field($model, 'bet_id')->textInput() ?>

    <?= $form->field($model, 'jackpot_event_id')->textInput() ?>

    <?= $form->field($model, 'total_games_correct')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
