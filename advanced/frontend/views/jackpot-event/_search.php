<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotEventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jackpot_event_id') ?>

    <?= $form->field($model, 'jackpot_type') ?>

    <?= $form->field($model, 'jackpot_name') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'bet_amount') ?>

    <?php // echo $form->field($model, 'total_games') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
