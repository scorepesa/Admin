<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserBetCancel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-bet-cancel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bet_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => 'Ronoh'])->label(false); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
