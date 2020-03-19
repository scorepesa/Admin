<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LiveOddsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="live-odds-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'live_odds_change_id') ?>

    <?= $form->field($model, 'parent_match_id') ?>

    <?= $form->field($model, 'subtype') ?>

    <?= $form->field($model, 'key') ?>

    <?= $form->field($model, 'value') ?>
    <?= $form->field($model, 'match_time') ?>
    <?= $form->field($model, 'score') ?>
    <?= $form->field($model, 'bet_status') ?>
    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'created')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
