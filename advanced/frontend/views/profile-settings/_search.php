<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileSettingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-settings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'profile_setting_id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'balance') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'verification_code') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'reference_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'max_stake') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
