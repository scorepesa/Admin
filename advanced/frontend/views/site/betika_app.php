<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Upload mobile app';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobile-app-upload">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])
    ?>

    <?= $form->field($model, 'apkFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('UploadApk', ['class' => 'btn btn-success']) ?>
    </div>
    <p>
        <?php //Html::a('PublishApk', ['app_publisher'], ['class' => 'btn btn-success']) ?>
        <?php
        /*$labeltext = '';
        $filedclass = 'btn btn-info';
        Html::a($labeltext, Url::to(['site/bapk-publish']), [
            'id' => 'grid-custom-button',
            'data-pjax' => true,
            'action' => Url::to(['site/bapk-publish']),
            'class' => [$filedclass],
            'data-toggle' => 'confirmation',
            'label' => [$labeltext],
                ]
        );*/
        ?>
    </p>
    <?php ActiveForm::end() ?>
</div>
