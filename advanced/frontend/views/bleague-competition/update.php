<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BleagueCompetition */

$this->title = 'Update Bleague Competition: ' . $model->competition_id;
$this->params['breadcrumbs'][] = ['label' => 'Bleague Competitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->competition_id, 'url' => ['view', 'id' => $model->competition_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bleague-competition-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
