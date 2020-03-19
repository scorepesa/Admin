<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Match;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bleague_event_odd-form">

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
   
     
       
    <div class="row" id="odds" style="display: none;">
    	<div class="col-md-4">
    		<?= $form->field($model, 'homeOdd')->textArea(array('id'=>'homeOdd','placeholder'=>'1','readonly' => false)) ?>
    	</div>
    	<div class="col-md-4">
    		<?= $form->field($model, 'drawOdd')->textArea(array('placeholder'=>'X','readonly' => false)) ?>
    	</div>
    	<div class="col-md-4">
    		<?= $form->field($model, 'awayOdd')->textArea(array('placeholder'=>'2','readonly' => false)) ?>
    	</div>
    </div>

    <?= $form->field($model, 'sub_type_id')->dropDownList([10 => '3 Way', 382    => '2 Way'], ['prompt' => 'Choose...']) ?>

    <?= $form->field($model, 'max_bet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>
    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <?= $form->field($model, 'modified')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

 <?= $form->field($model, 'status')->dropDownList([1 => 'ACTIVE', 2 => 'INACTIVE'], ['prompt' => 'Choose...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','data-toggle' => 'confirmation',]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
