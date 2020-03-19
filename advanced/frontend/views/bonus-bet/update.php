<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BonusBet */

$this->title = 'Update Bonus Bet: ' . $model->bonus_bet_id;
$this->params['breadcrumbs'][] = ['label' => 'Bonus Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bonus_bet_id, 'url' => ['view', 'id' => $model->bonus_bet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bonus-bet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
