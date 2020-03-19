<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualEventOdd */

$this->title = $model->v_event_odd_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtual Event Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtual-event-odd-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->v_event_odd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->v_event_odd_id], [
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
            'v_event_odd_id',
            'parent_virtual_id',
            'sub_type_id',
            'max_bet',
            'created',
            'modified',
            'odd_key',
            'odd_value',
            'odd_alias',
            'special_bet_value',
        ],
    ]) ?>

</div>
