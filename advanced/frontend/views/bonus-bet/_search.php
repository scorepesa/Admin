<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BonusBetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bonus-bet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bonus_bet_id') ?>

    <?= $form->field($model, 'bet_id') ?>

    <?= $form->field($model, 'bet_amount') ?>

    <?= $form->field($model, 'possible_win') ?>

    <?= $form->field($model, 'profile_bonus_id') ?>

    <?php // echo $form->field($model, 'won') ?>

    <?php // echo $form->field($model, 'ratio') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
