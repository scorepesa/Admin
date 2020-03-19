<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Outcome */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outcome-form">
     <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id')->textInput() ?>
    <?=
    $form->field($model, 'sub_type_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => [47=>'DrawNoBet', 235=> 'AnytimeGoalScorer'],
    ])->label('Subtype');
    ?>
    <?= $form->field($model, 'odd_key')->textInput() ?>
    



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Result' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
