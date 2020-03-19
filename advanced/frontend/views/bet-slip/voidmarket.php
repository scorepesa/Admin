<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BetSlip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bet-slip-form">

    <?php
    $form = ActiveForm::begin([
                'layout' => 'horizontal',
    ]);
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            Market Voiding
        </div>
    </div>


    <?=
    $form->field($model, 'parent_match_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $model->matches_to_void(),
    ])->label('Search Match');
    ?>
    <?=
    $form->field($model, 'sub_type_id')->widget(\yii2mod\chosen\ChosenSelect::className(), [
        'items' => $model->all_odd_types(),
    ])->label('Search Market');
    ?>

    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-11">
            <?= Html::submitButton('Click to Void', ['class' => 'btn btn-primary', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>