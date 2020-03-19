<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MtsTicketSubmitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mts-ticket-submit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'mts_ticket_submit_id') ?>

    <?= $form->field($model, 'bet_id') ?>

    <?= $form->field($model, 'mts_ticket') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'response') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
