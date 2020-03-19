<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotBet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-bet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bet_id')->textInput() ?>

    <?= $form->field($model, 'jackpot_event_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'ACTIVE' => 'ACTIVE', 'CANCELLED' => 'CANCELLED', 'FINISHED' => 'FINISHED', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
