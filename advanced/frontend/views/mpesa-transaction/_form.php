<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MpesaTransaction */
/* @var $form yii\widgets\ActiveForm */
$listData = array(
    'SCOREPESA' => 'SCOREPESA'
);
?>

<div class="mpesa-transaction-form">

    <?php
    $form = ActiveForm::begin([
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-4',
                        'offset' => 'col-sm-offset-4',
                        'wrapper' => 'col-sm-8',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
    ]);
    ?>


    <?= $form->field($model, 'msisdn')->textInput() ?>

    <?=
    $form->field($model, 'transaction_time')->widget(
            '\kartik\datetime\DateTimePicker', [
        'name' => 'transaction_time',
        'options' => ['placeholder' => date('Y-m-d H:i:s')],
        'convertFormat' => true,
        'removeButton' => false,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd H:i:s',
            'startDate' => date('Y-m-d H:i:s'),
            'todayHighlight' => true,
            'autoclose' => true,
        ]
    ])
    ?>

    <?= $form->field($model, 'mpesa_customer_id')->textInput() ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_no')->dropDownList($listData, ['prompt' => 'Choose...']) ?>

    <?= $form->field($model, 'mpesa_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mpesa_amt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mpesa_sender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_number')->checkbox(array('label' => '290290')); ?>

    <?=
    $form->field($model, 'created')->widget(
            '\kartik\datetime\DateTimePicker', [
        'name' => 'created',
        'options' => ['placeholder' => date('Y-m-d H:i:s')],
        'convertFormat' => true,
        'removeButton' => false,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd H:i:s',
            'startDate' => date('Y-m-d H:i:s'),
            'todayHighlight' => true,
            'autoclose' => true,
        ]
    ])
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
