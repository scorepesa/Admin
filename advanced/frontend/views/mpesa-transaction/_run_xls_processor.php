<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MpesaTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpesa-transaction-form">

    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    ?>

    <?=
    $form->field($model, 'run', ['options' => ['value' => 1]])->textInput(['readonly' => true]);
//->label("Sub type"); 
    ?>
    <div class="form-group">
        <?= Html::submitButton('Run Processor', ['class' => 'btn btn-primary']) ?>
    </div>
<!--
    <p>
        <?= Html::a('Missed Receipts', ['logviewer'], ['class' => 'btn btn-info']) ?>
    </p>
-->
    <p>
        <?= Html::a('Back to Uploading', ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php ActiveForm::end(); ?>

</div>
