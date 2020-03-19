<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightCompetitor */

$this->title = $model->competitor_id;
$this->params['breadcrumbs'][] = ['label' => 'Outright Competitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-competitor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->competitor_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->competitor_id], [
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
            'competitor_id',
            'parent_outright_id',
            'betradar_competitor_id',
            'betradar_super_id',
            'competitor_name',
            'status',
            'priority',
            'created_by',
            'created',
            'modified',
        ],
    ]) ?>

</div>
