<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Outcome */

$this->title = 'Update Outcome: ' . $model->match_result_id;
$this->params['breadcrumbs'][] = ['label' => 'Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->match_result_id, 'url' => ['view', 'id' => $model->match_result_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outcome-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update_form', [
        'model' => $model,
    ]) ?>

</div>
