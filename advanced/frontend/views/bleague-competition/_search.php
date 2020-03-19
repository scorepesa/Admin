<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BleagueCompetitionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bleague-competition-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'competition_id') ?>

    <?= $form->field($model, 'competition_name') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'sport_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'max_stake') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
