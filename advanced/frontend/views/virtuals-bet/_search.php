<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsBetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtuals-bet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bet_id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'bet_message') ?>

    <?= $form->field($model, 'total_odd') ?>

    <?= $form->field($model, 'bet_amount') ?>

    <?php // echo $form->field($model, 'possible_win') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'win') ?>

    <?php // echo $form->field($model, 'reference') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
