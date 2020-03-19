<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotMatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'parent_match_id')->textInput(['value' => $model->parent_match_id])->label('Match');
    ?>

    <?= $form->field($model, 'status')->dropDownList(['CANCELLED' => 'CANCELLED', 'POSTPONED' => 'POSTPONED', 'ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE'], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>

    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>
    <?=
    $form->field($model, 'jackpot_event_id')->textInput(['value' => $model->jackpot_event_id])->label('Jackpot event');
    ?>
    <?= $form->field($model, 'game_order')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

