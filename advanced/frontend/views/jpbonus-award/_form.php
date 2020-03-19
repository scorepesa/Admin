<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JpbonusAward */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jpbonus-award-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jackpot_event_id')->textInput() ?>

    <?= $form->field($model, 'jackpot_bonus')->textInput() ?>

    <!-- <?= //$form->field($model, 'scorepesa_points_bonus')->textInput() ?> -->

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => 'Admin'])->label(false); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
