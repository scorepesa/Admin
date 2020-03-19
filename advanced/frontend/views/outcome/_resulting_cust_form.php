<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Outcome */
/* @var $form yii\widgets\ActiveForm */
//print_r($model->outcome_special_bet_values($model->sub_type_id, $model->parent_match_id));
//die();
?>

<div class="outcome-score-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_match_id', ['options' => ['value' => $model->parent_match_id]])->hiddenInput()->label(false); ?>
    <?=
    $form->field($model, 'sub_type_id', ['options' => ['value' => $model->sub_type_id]])->textInput(['readonly' => true])->label("Sub type");
    ?>
    <?php if ($model->outcome_special_bet_values($model->sub_type_id, $model->parent_match_id)) : ?>
        <?=
                $form->field($model, 'special_bet_value')
                ->dropDownList(
                        $model->outcome_special_bet_values($model->sub_type_id, $model->parent_match_id), ['prompt' => 'Select Special bet value']    // options
                )->label('Special bet value');
        ?>
    <?php endif; ?>
    <?php if ($model->sub_type_id == 235) : ?>
        <?=
                $form->field($model, 'anytime_goal_scorers')
                ->dropDownList(
                        $model->event_anytime_goal_scorers($model->parent_match_id), [
                    'multiple' => 'multiple',
                    'class' => 'chosen-select input-md',
                        ], ['prompt' => 'Select not play goal scorers'] // options
                )->label('Select players who did not play(Use CTRL key + Mouse Click)');
        ?>
    <?php endif; ?>
    <?php if ($model->sub_type_id == 46) { ?>
        <?=
                $form->field($model, 'cust_result')
                ->dropDownList(
                        $model->outcome_dropdown($model->sub_type_id, $model->parent_match_id, $key = 2), [
                    'multiple' => 'multiple',
                    'class' => 'chosen-select input-md',
                        ], ['prompt' => 'Select Outcome'] // options
                )->label('Outcome(Use CTRL key + Mouse Click)');
        ?>
    <?php } elseif ($model->sub_type_id == 235) { ?>
        <?=
                $form->field($model, 'cust_result')
                ->dropDownList(
                        $model->event_anytime_goal_scorers($model->parent_match_id), [
                    'multiple' => 'multiple',
                    'class' => 'chosen-select input-md',
                        ], ['prompt' => 'Select goal scorers'] // options
                )->label('Select goal scorers(Use CTRL key + Mouse Click)');
        ?>
    <?php } elseif ($model->sub_type_id == 236 || $model->sub_type_id == 272) { ?>
        <?= $form->field($model, 'cust_result')->textInput()->label('Total Number'); ?>
    <?php } else { ?>
        <?=
                $form->field($model, 'cust_result')
                ->dropDownList(
                        $model->outcome_dropdown($model->sub_type_id, $model->parent_match_id, $key = 2), ['prompt' => 'Select Outcome']    // options
                )->label('Outcome');
        ?>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>