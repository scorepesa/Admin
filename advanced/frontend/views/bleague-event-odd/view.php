<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BleagueEventOdd */

$this->title = $model->event_odd_id;
$this->params['breadcrumbs'][] = ['label' => 'Bleague Event Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bleague-event-odd-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->event_odd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->event_odd_id], [
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
            'event_odd_id',
            'parent_match_id',
            'sub_type_id',
            'max_bet',
            'created_by',
            'created',
            'modified',
            'odd_key',
            'odd_value',
            'odd_alias',
            'status',
        ],
    ]) ?>

</div>
