<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualEventOdd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="virtual-event-odd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_virtual_id')->textInput() ?>

    <?= $form->field($model, 'sub_type_id')->textInput() ?>

    <?= $form->field($model, 'max_bet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'odd_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'odd_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'odd_alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'special_bet_value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
