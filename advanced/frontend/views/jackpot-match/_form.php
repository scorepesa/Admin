<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotMatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-match-form">

    <?php $form = ActiveForm::begin(); ?>

    <label>Matches</label>
    <?= Select2::widget([
    'name' => 'parent_match_id',
    'value' => '',
    'data' => $model->jackpot_viable_matches(),
    'options' => ['multiple' => true, 'placeholder' => 'Select games ...']
    ]); ?>
    <br>

    <?= $form->field($model, 'status')->dropDownList(['CANCELLED' => 'CANCELLED', 'POSTPONED' => 'POSTPONED', 'ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE'], ['prompt' => 'Select Status']) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>

    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>
    <?=
    $form->field($model, 'jackpot_event_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $model->fetch_jackpot_events(),
    ])->label('Jackpot event');
    ?>
    <?php //$form->field($model, 'game_order')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

