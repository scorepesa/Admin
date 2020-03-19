<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsOutcomeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtuals-outcome-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'match_result_id') ?>

    <?= $form->field($model, 'sub_type_id') ?>

    <?= $form->field($model, 'parent_match_id') ?>

    <?= $form->field($model, 'special_bet_value') ?>

    <?= $form->field($model, 'live_bet') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'approved_by') ?>

    <?php // echo $form->field($model, 'approved_status') ?>

    <?php // echo $form->field($model, 'date_approved') ?>

    <?php // echo $form->field($model, 'winning_outcome') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
