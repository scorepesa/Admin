<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outright-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'outright_id') ?>

    <?= $form->field($model, 'parent_outright_id') ?>

    <?= $form->field($model, 'event_name') ?>

    <?= $form->field($model, 'event_date') ?>

    <?= $form->field($model, 'event_end_date') ?>

    <?php // echo $form->field($model, 'game_id') ?>

    <?php // echo $form->field($model, 'competition_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'instance_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'completed') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
