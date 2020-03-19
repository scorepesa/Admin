<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OddsChangeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="odds-change-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'odds_change_id') ?>

    <?= $form->field($model, 'parent_match_id') ?>

    <?= $form->field($model, 'subtype') ?>

    <?= $form->field($model, 'key') ?>

    <?= $form->field($model, 'value') ?>

    <?php // echo $form->field($model, 'match_time') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'bet_status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
