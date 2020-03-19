<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileBalanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-balance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'profile_balance_id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'balance') ?>

    <?= $form->field($model, 'transaction_id') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
