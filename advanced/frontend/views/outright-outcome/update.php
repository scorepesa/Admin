<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightOutcome */

$this->title = 'Update Outright Outcome: ' . $model->outcome_id;
$this->params['breadcrumbs'][] = ['label' => 'Outright Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->outcome_id, 'url' => ['view', 'id' => $model->outcome_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outright-outcome-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
