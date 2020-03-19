<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OddKeyAlias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="odd-key-alias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'sub_type_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $model->all_odd_types(),
    ])->label('Sub Type');
    ?>

    <?= $form->field($model, 'odd_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'odd_key_alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'special_bet_value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
