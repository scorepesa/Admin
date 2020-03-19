<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Match */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'home_team')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'away_team')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'start_time')->widget(
            '\kartik\datetime\DateTimePicker', [
        'name' => 'start_time',
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

    <?= $form->field($model, 'game_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'competition_id')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput(['values' => $model->priority ? $model->priority : "50"]) ?>
    <?= $form->field($model, 'ussd_priority')->textInput(['values' => $model->ussd_priority ? $model->ussd_priority : "0"]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?=
    $form->field($model, 'bet_closure')->widget(
            '\kartik\datetime\DateTimePicker', [
        'name' => 'bet_closure',
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

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>

    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
