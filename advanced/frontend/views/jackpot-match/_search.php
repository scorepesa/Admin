<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotMatchSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-match-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jackpot_match_id') ?>

    <?= $form->field($model, 'parent_match_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
