<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MatchBet */

$this->title = 'Update Match Bet: ' . $model->match_bet_id;
$this->params['breadcrumbs'][] = ['label' => 'Match Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->match_bet_id, 'url' => ['view', 'id' => $model->match_bet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="match-bet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'disabled' => 'disabled'
    ])
    ?>

</div>
