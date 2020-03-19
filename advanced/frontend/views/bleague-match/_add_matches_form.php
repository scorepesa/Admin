<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\BleagueMatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bleague-match-form">

    <?php $form = ActiveForm::begin(); ?>

   <label>Matches</label>
    <?= Select2::widget([
    'name' => 'parent_match_id',
    'value' => '',
    'data' => $model->match_to_add(),
    'options' => ['multiple' => true, 'placeholder' => 'Select games ...']
    ]); ?>

    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <?= $form->field($model, 'modified')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <br />
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
