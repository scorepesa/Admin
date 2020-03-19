<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\JackpotEvent;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\JpbonusAward */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jpbonus-award-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jackpot_event_id')->widget(Select2::classname(), [
        'data' => $model->event_to_award(),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a event ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php echo $form->field($model, 'total_games_correct[]')->dropDownList(['10' => '10', '11' => '11', '12' => '12']); ?>
    <br>
    <?= $form->field($model, 'jackpot_bonus')->textInput() ?>

    <?= $form->field($model, 'scorepesa_points_bonus')->hiddenInput(['value'=>0])->label(false) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Award Bonus' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
