<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPointTrx */

$this->title = 'Update Scorepesa Point Trx: ' . $model->scorepesa_point_trx_id;
$this->params['breadcrumbs'][] = ['label' => 'Scorepesa Point Trxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->scorepesa_point_trx_id, 'url' => ['view', 'id' => $model->scorepesa_point_trx_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scorepesa-point-trx-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
