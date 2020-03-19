<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPointTrx */

$this->title = $model->scorepesa_point_trx_id;
$this->params['breadcrumbs'][] = ['label' => 'Scorepesa Point Trxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scorepesa-point-trx-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->scorepesa_point_trx_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->scorepesa_point_trx_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'scorepesa_point_trx_id',
            'trx_id',
            'points',
            'trx_type',
            'status',
            'created',
            'modified',
        ],
    ]) ?>

</div>
