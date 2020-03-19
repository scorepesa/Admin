<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IncomingMatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incoming-match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sport_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'competition_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'competition_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'home_team')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'away_team')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'home_odd')->textInput() ?>

    <?= $form->field($model, 'neutral_odd')->textInput() ?>

    <?= $form->field($model, 'away_odd')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
