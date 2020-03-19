<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\BleagueEventOdd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bleague-event-odd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->widget(Select2::classname(), [
        'data' => $model->match_to_add(),
        'language' => 'en',
        'class'=>'drop',
        'options' => ['placeholder' => 'Select a match ...', 'class'=>'drop', 'id'=>'drop', 'onchange'=>'$("#odds").show();'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'sub_type_id')->widget(Select2::classname(), [
        'data' => $model->fetch_custom_markets(),
        'language' => 'en',
        'class'=>'drop',
        'options' => ['placeholder' => 'Select a market ...', 'class'=>'drops', 'id'=>'drops'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>

    <?php // $form->field($model, 'sub_type_id')->dropDownList([10 => '3 Way', 382    => '2 Way'], ['prompt' => 'Choose...']) ?>

    <?php $form->field($model, 'max_bet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>
    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <?= $form->field($model, 'modified')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <?php // $form->field($model, 'odd_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'odd_key')->textArea(['placeholder' => 'Mesii=1.50, Ronaldo=2.04']) ?>

    <?php // $form->field($model, 'odd_value')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'odd_alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'ACTIVE', 2 => 'INACTIVE'], ['prompt' => 'Choose...']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
