<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotTrx */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-trx-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trx_id')->textInput() ?>

    <?= $form->field($model, 'jackpot_event_id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
