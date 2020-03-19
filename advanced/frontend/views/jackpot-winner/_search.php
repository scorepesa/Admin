<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotWinnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-winner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jackpot_winner_id') ?>

    <?= $form->field($model, 'win_amount') ?>

    <?= $form->field($model, 'bet_id') ?>

    <?= $form->field($model, 'jackpot_event_id') ?>

    <?= $form->field($model, 'total_games_correct') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
