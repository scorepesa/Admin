<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\BootstrapWidgetTrait;

/* @var $this yii\web\View */
/* @var $model app\models\Bet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bet-form">

    <?php
    $form = ActiveForm::begin([
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-4',
                        'offset' => 'col-sm-offset-4',
                        'wrapper' => 'col-sm-8',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
    ]);
    ?>


    <?= $form->field($model, 'profile_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'bet_message')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'total_odd')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'bet_amount')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'possible_win')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'win')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'created')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'modified')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
