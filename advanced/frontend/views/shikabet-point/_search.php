<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPointSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scorepesa-point-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'scorepesa_point_id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'points') ?>

    <?= $form->field($model, 'redeemed_amount') ?>

    <?= $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
