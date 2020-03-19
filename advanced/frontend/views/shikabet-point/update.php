<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPoint */

$this->title = 'Update Scorepesa Point: ' . $model->scorepesa_point_id;
$this->params['breadcrumbs'][] = ['label' => 'Scorepesa Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->scorepesa_point_id, 'url' => ['view', 'id' => $model->scorepesa_point_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scorepesa-point-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
