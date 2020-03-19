<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OddTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="odd-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bet_type_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'sub_type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
