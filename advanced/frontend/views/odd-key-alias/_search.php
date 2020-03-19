<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OddKeyAliasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="odd-key-alias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'odd_key_alias_id') ?>

    <?= $form->field($model, 'sub_type_id') ?>

    <?= $form->field($model, 'odd_key') ?>

    <?= $form->field($model, 'odd_key_alias') ?>

    <?= $form->field($model, 'special_bet_value') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
