<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SevenAggregatorRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seven-aggregator-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_small')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_strategy')->dropDownList([ 'strictSingle' => 'StrictSingle', 'flexibleMultiple' => 'FlexibleMultiple', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'transactionType')->dropDownList([ 'reserveFunds' => 'ReserveFunds', 'credit' => 'Credit', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'payment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reference_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tp_token')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ticket_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'security_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'club_uuid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'aggregator_status')->dropDownList([ 'cancelled' => 'Cancelled', 'completed' => 'Completed', 'processing' => 'Processing', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'date_modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
