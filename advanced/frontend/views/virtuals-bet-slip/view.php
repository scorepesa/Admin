<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsBetSlip */

$this->title = $model->bet_slip_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtuals Bet Slips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-bet-slip-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bet_slip_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bet_slip_id], [
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
            'bet_slip_id',
            'parent_match_id',
            'bet_id',
            'bet_pick',
            'special_bet_value',
            'total_games',
            'odd_value',
            'win',
            'live_bet',
            'created',
            'modified',
            'status',
            'sub_type_id',
        ],
    ]) ?>

</div>
