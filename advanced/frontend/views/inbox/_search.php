<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InboxSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inbox-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'inbox_id') ?>

    <?= $form->field($model, 'network') ?>

    <?= $form->field($model, 'shortcode') ?>

    <?= $form->field($model, 'msisdn') ?>

    <?= $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'linkid') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
