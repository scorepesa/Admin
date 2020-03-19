<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightOutcomeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outright-outcome-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'outcome_id') ?>

    <?= $form->field($model, 'parent_outright_id') ?>

    <?= $form->field($model, 'betradar_competitor_id') ?>

    <?= $form->field($model, 'odd_type') ?>

    <?= $form->field($model, 'special_bet_value') ?>

    <?php // echo $form->field($model, 'outcome') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
