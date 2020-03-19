<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BleagueCompetition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bleague-competition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'competition_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'ACTIVE', 2 => 'INACTIVE'], ['prompt' => 'Choose...']) ?>


    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>

    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <?= $form->field($model, 'modified')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'max_stake')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sport_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $model->fetch_sports(),
    ])->label('Sport ID'); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
