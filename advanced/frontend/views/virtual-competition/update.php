<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualCompetition */

$this->title = 'Update Virtual Competition: ' . $model->v_competition_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtual Competitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->v_competition_id, 'url' => ['view', 'id' => $model->v_competition_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="virtual-competition-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
