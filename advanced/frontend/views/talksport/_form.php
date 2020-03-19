<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Talksport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="talksport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textInput() ?>

    <?= $form->field($model, 'stream_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
