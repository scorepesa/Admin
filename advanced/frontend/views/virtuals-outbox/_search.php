<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsOutboxSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtuals-outbox-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'outbox_id') ?>

    <?= $form->field($model, 'shortcode') ?>

    <?= $form->field($model, 'network') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'linkid') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_sent') ?>

    <?php // echo $form->field($model, 'retry_status') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'msisdn') ?>

    <?php // echo $form->field($model, 'sdp_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
