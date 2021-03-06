<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPointBetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scorepesa-point-bet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'scorepesa_point_bet_id') ?>

    <?= $form->field($model, 'bet_id') ?>

    <?= $form->field($model, 'scorepesa_point_trx_id') ?>

    <?= $form->field($model, 'points') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
