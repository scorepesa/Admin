<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Outright */

$this->title = $model->outright_id;
$this->params['breadcrumbs'][] = ['label' => 'Outrights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->outright_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->outright_id], [
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
            'outright_id',
            'parent_outright_id',
            'event_name',
            'event_date',
            'event_end_date',
            'game_id',
            'competition_id',
            'status',
            'instance_id',
            'created_by',
            'created',
            'modified',
            'result',
            'completed',
            'priority',
        ],
    ]) ?>

</div>
