<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Outcome */
/* @var $form yii\widgets\ActiveForm */
$enable = ['class' => 'btn btn-warning', 'data-toggle' => 'confirmation', 'data-placement' => "top"];
$disable = ['class' => 'btn btn-default btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top", 'disabled' => 'disabled'];
?>

<div class="outcome-score-form">

    <?php $form = ActiveForm::begin(['action' => ['outcome/approveoutcome'], 'id' => 'outcome-approve-post', 'method' => 'post',]); ?>

    <?= $form->field($model, 'parent_match_id', ['options' => ['value' => $model->parent_match_id]])->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Approve', $model->check_approved_status($model->parent_match_id) ? $enable : $disable) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
