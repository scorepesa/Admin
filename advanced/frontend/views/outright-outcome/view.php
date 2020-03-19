<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightOutcome */

$this->title = $model->outcome_id;
$this->params['breadcrumbs'][] = ['label' => 'Outright Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-outcome-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->outcome_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->outcome_id], [
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
            'outcome_id',
            'parent_outright_id',
            'betradar_competitor_id',
            'odd_type',
            'special_bet_value',
            'outcome',
            'status',
            'created_by',
            'created',
            'modified',
        ],
    ]) ?>

</div>
