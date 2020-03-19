<?php

// with UI

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Upload C2B Transactions';
$this->params['breadcrumbs'][] = ['label' => 'C2B Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpesa-transaction-upload">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])
    ?>

    <?= $form->field($model, 'mediaFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
