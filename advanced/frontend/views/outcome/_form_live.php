<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Outcome */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outcome-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'sub_type_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $model->live_odd_types(),
    ])->label('Subtype');
    ?>

    <?=
    $form->field($model, 'parent_match_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $model->live_matches_to_result(),
    ])->label('Match');
    ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>
    <?= $form->field($model, 'special_bet_value')->textInput() ?>
    <?= $form->field($model, 'winning_outcome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <?= $form->field($model, 'status')->hiddenInput(['value' => 0])->label(false); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
