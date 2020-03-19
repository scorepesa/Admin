<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPointBet */

$this->title = 'Update Scorepesa Point Bet: ' . $model->scorepesa_point_bet_id;
$this->params['breadcrumbs'][] = ['label' => 'Scorepesa Point Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->scorepesa_point_bet_id, 'url' => ['view', 'id' => $model->scorepesa_point_bet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scorepesa-point-bet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
