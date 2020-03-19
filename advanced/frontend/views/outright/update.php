<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Outright */

$this->title = 'Update Outright: ' . $model->outright_id;
$this->params['breadcrumbs'][] = ['label' => 'Outrights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->outright_id, 'url' => ['view', 'id' => $model->outright_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outright-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
