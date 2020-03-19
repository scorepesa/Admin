<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompetitionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competition-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'competition_id') ?>

    <?= $form->field($model, 'competition_name') ?>

    <?= $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php echo $form->field($model, 'sport_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

        <?php // echo $form->field($model, 'modified')  ?>

    <div class="form-group">
<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
