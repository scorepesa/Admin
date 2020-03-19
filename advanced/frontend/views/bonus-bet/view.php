<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BonusBet */

$this->title = $model->bonus_bet_id;
$this->params['breadcrumbs'][] = ['label' => 'Bonus Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonus-bet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bonus_bet_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bonus_bet_id], [
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
            'bonus_bet_id',
            'bet_id',
            'bet_amount',
            'possible_win',
            'profile_bonus_id',
            'won',
            'ratio',
            'created_by',
            'created',
            'modified',
        ],
    ]) ?>

</div>
