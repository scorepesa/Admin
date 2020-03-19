<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsOutcome */

$this->title = 'Update Virtuals Outcome: ' . $model->match_result_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtuals Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->match_result_id, 'url' => ['view', 'id' => $model->match_result_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="virtuals-outcome-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
