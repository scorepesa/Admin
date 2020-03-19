<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotBet */

$this->title = 'Update Jackpot Bet: ' . $model->jackpot_bet_id;
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jackpot_bet_id, 'url' => ['view', 'id' => $model->jackpot_bet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jackpot-bet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form3', [
        'model' => $model,
    ]) ?>

</div>
