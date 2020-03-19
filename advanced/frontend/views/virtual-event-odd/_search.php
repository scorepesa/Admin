<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualEventOddSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtual-event-odd-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'v_event_odd_id') ?>

    <?= $form->field($model, 'parent_virtual_id') ?>

    <?= $form->field($model, 'sub_type_id') ?>

    <?= $form->field($model, 'max_bet') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'odd_key') ?>

    <?php // echo $form->field($model, 'odd_value') ?>

    <?php // echo $form->field($model, 'odd_alias') ?>

    <?php // echo $form->field($model, 'special_bet_value') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
