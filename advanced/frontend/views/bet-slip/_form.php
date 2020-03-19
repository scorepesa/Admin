<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BetSlip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bet-slip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'bet_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'bet_pick')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'total_games')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'odd_value')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'win')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'created')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'modified')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'sub_type_id')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
