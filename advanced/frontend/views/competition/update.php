<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Competition */

$this->title = 'Update Competition: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Competitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->competition_id, 'url' => ['view', 'id' => $model->competition_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="competition-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
