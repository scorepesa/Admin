<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SevenAggregatorRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seven-aggregator-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'request_name') ?>

    <?= $form->field($model, 'amount_small') ?>

    <?= $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'payment_strategy') ?>

    <?php // echo $form->field($model, 'transactionType') ?>

    <?php // echo $form->field($model, 'payment_id') ?>

    <?php // echo $form->field($model, 'transaction_id') ?>

    <?php // echo $form->field($model, 'source_id') ?>

    <?php // echo $form->field($model, 'reference_id') ?>

    <?php // echo $form->field($model, 'tp_token') ?>

    <?php // echo $form->field($model, 'ticket_info') ?>

    <?php // echo $form->field($model, 'security_hash') ?>

    <?php // echo $form->field($model, 'club_uuid') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'aggregator_status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
