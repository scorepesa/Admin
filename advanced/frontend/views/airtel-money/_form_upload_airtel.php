<?php

// with UI

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$model = new app\models\UploadXlsForm();
$this->title = 'Upload Airtel deposits';
$this->params['breadcrumbs'][] = ['label' => 'Airtel Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpesa-transaction-upload">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])
    ?>

    <?= $form->field($model, 'mediaFile')->fileInput() ?>

    <?php ActiveForm::end() ?>
</div>
