<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Talksport */

$this->title = 'Update Talksport: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Talksports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->talksport_id, 'url' => ['view', 'id' => $model->talksport_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="talksport-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
