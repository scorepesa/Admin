<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Competition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'competition_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([1 => 'ACTIVE', 2 => 'INACTIVE'], ['prompt' => 'Choose...']) ?>
    <?= $form->field($model, 'priority')->textInput() ?>
    <?= $form->field($model, 'ussd_priority')->textInput() ?>
    <?= $form->field($model, 'max_stake')->textInput() ?>
    <?= $form->field($model, 'sport_id')->textInput() ?>
    <?= $form->field($model, 'category')->textInput() ?>
    <?= $form->field($model, 'category_id')->textInput() ?>
    <?= $form->field($model, 'betradar_competition_id')->textInput() ?>
    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>

    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <div class="form-group">	
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
