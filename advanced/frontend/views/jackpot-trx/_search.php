<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotTrxSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-trx-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jackpot_trx_id') ?>

    <?= $form->field($model, 'trx_id') ?>

    <?= $form->field($model, 'jackpot_event_id') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
