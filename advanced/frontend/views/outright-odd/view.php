<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightOdd */

$this->title = $model->odd_id;
$this->params['breadcrumbs'][] = ['label' => 'Outright Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-odd-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->odd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->odd_id], [
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
            'odd_id',
            'parent_outright_id',
            'betradar_competitor_id',
            'odd_type',
            'odd_value',
            'special_bet_value',
            'status',
            'created_by',
            'created',
            'modified',
        ],
    ]) ?>

</div>
