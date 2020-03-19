<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sport-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sport_id') ?>

    <?= $form->field($model, 'sport_name') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
