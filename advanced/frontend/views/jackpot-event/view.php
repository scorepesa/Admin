<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotEvent */

$this->title = $model->jackpot_event_id;
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->jackpot_event_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->jackpot_event_id], [
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
            'jackpot_event_id',
            'jackpot_type',
            'jackpot_name',
            'created_by',
            'status',
            'bet_amount',
            'total_games',
            'created',
            'modified',
        ],
    ]) ?>

</div>
