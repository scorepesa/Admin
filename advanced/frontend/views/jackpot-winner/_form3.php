<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotWinner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jackpot-winner-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=
    $form->field($model, 'jackpot_event_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $jpmatch_model->fetch_jackpot_events(),
    ])->label('Jackpot event');
    ?>
    <?= $form->field($model, 'total_games_correct')->dropDownList([ 13 => '13/13 Winners', 12 => '12/13 Winners', 11 => '11/13 Winners', 10 => '10/13 Winners'], ['prompt' => 'Choose Winners']) ?>
    <!--  <?= $form->field($model, 'win_amount')->textInput() ?> -->
    
    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>

    <?= $form->field($model, 'created')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
