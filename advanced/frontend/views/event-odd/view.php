<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MatchBet */

$this->title = $model->event_odd_id;
$this->params['breadcrumbs'][] = ['label' => 'Event Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-odd-view">

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
            'odd_key',
            'odd_value',
            'odd_alias',
            'created',
            'modified',
        ],
    ]) ?>

</div>
