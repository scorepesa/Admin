<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MatchBet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="match-bet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'parent_match_id')->dropDownList(
            yii\helpers\ArrayHelper::map(app\models\Match::find()->all(), 'parent_match_id', function($model, $defaultValue) {
                return $model['start_time'] . " " . $model['home_team'] . ' vs ' . $model['away_team'];
            }
            ), ['prompt' => "", $disabled => $disabled])
    ?>

    <?=
    $form->field($model, 'sub_type_id')->dropDownList(
            yii\helpers\ArrayHelper::map(app\models\OddType::find()->all(), 'sub_type_id', 'name'), ['prompt' => "", $disabled => $disabled])
    ?>

    <?= $form->field($model, 'odd_key')->textInput() ?>

    <?= $form->field($model, 'odd_value')->textInput() ?>

    <?= $form->field($model, 'odd_alias')->textInput() ?>

    <?= $form->field($model, 'max_bet')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'created')->widget(
            '\kartik\datetime\DateTimePicker', [
        'name' => 'created',
        'options' => ['placeholder' => date('Y-m-d H:i:s')],
        'convertFormat' => true,
        'removeButton' => false,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd H:i:s',
            'startDate' => date('Y-m-d H:i:s'),
            'todayHighlight' => true,
            'autoclose' => true,
        ]
    ])
    ?>


    <?=
    $form->field($model, 'modified')->widget(
            '\kartik\datetime\DateTimePicker', [
        'name' => 'created',
        'options' => ['placeholder' => date('Y-m-d H:i:s')],
        'convertFormat' => true,
        'removeButton' => false,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd H:i:s',
            'startDate' => date('Y-m-d H:i:s'),
            'todayHighlight' => true,
            'autoclose' => true,
        ]
    ])
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
