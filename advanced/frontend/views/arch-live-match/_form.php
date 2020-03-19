<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArchLiveMatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="arch-live-match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textInput() ?>

    <?= $form->field($model, 'home_team')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'away_team')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'game_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'competition_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'instance_id')->textInput() ?>

    <?= $form->field($model, 'bet_closure')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ht_score')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ft_score')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'completed')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
