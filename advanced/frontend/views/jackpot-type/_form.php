<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-type-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=
    $form->field($model, 'sub_type_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $model->all_odd_types(),
    ])->label('Subtype');
    ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
