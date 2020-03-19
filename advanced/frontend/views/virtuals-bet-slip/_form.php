<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsBetSlip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtuals-bet-slip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textInput() ?>

    <?= $form->field($model, 'bet_id')->textInput() ?>

    <?= $form->field($model, 'bet_pick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'special_bet_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_games')->textInput() ?>

    <?= $form->field($model, 'odd_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'win')->textInput() ?>

    <?= $form->field($model, 'live_bet')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'sub_type_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
