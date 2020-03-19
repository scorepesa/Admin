<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualMatchSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtual-match-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'v_match_id') ?>

    <?= $form->field($model, 'parent_virtual_id') ?>

    <?= $form->field($model, 'home_team') ?>

    <?= $form->field($model, 'away_team') ?>

    <?= $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'competition_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'instance_id') ?>

    <?php // echo $form->field($model, 'bet_closure') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'ht_score') ?>

    <?php // echo $form->field($model, 'ft_score') ?>

    <?php // echo $form->field($model, 'completed') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
