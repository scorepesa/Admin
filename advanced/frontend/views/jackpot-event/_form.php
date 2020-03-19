<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotEvent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'jackpot_type')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $model->jackpot_types(),
    ])->label('Jackpot type');
    ?>

    <?= $form->field($model, 'jackpot_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>

    <?= $form->field($model, 'status')->dropDownList(['CANCELLED' => 'CANCELLED', 'ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE', 'SUSPENDED' => 'SUSPENDED', 'FINISHED' => 'FINISHED', 'OTHER' => 'OTHER',], ['prompt' => 'Choose....']) ?>

    <?= $form->field($model, 'bet_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_games')->textInput() ?>
    <?= $form->field($model, 'jackpot_amount')->textInput() ?>
    <?= $form->field($model, 'requisite_wins')->textInput() ?>
    <?= $form->field($model, 'jp_key')->textInput() ?>

    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
