<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsBetSlipSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtuals-bet-slip-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bet_slip_id') ?>

    <?= $form->field($model, 'parent_match_id') ?>

    <?= $form->field($model, 'bet_id') ?>

    <?= $form->field($model, 'bet_pick') ?>

    <?= $form->field($model, 'special_bet_value') ?>

    <?php // echo $form->field($model, 'total_games') ?>

    <?php // echo $form->field($model, 'odd_value') ?>

    <?php // echo $form->field($model, 'win') ?>

    <?php // echo $form->field($model, 'live_bet') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'sub_type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
