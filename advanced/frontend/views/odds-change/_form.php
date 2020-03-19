<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OddsChange */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="odds-change-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subtype')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'key')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'match_time')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'score')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bet_status')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
