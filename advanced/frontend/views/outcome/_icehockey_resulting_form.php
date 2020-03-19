<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Outcome */
/* @var $form yii\widgets\ActiveForm */
//if (!$model->check_approved_status($model->parent_match_id)) {
?>

<div class="outcome-score-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id', ['options' => ['value' => $model->parent_match_id]])->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'stPeriod_score')->textInput() ?>
    <?= $form->field($model, 'ndPeriod_score')->textInput() ?>
    <?= $form->field($model, 'rdPeriod_score')->textInput() ?>
    <?= $form->field($model, 'AOT_score')->textInput() ?>

    <?php ActiveForm::end(); ?>

</div>
<?php //}?>
