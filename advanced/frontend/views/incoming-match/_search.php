<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IncomingMatchSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incoming-match-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'incoming_match_id') ?>

    <?= $form->field($model, 'parent_match_id') ?>

    <?= $form->field($model, 'sport_name') ?>

    <?= $form->field($model, 'competition_name') ?>

    <?= $form->field($model, 'competition_category') ?>

    <?php // echo $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'end_time') ?>

    <?php // echo $form->field($model, 'home_team') ?>

    <?php // echo $form->field($model, 'away_team') ?>

    <?php // echo $form->field($model, 'home_odd') ?>

    <?php // echo $form->field($model, 'neutral_odd') ?>

    <?php // echo $form->field($model, 'away_odd') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
