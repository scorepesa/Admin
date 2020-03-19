<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileBonusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-bonus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'profile_bonus_id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'referred_msisdn') ?>

    <?= $form->field($model, 'bonus_amount') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'expiry_date') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
