<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JackpotBet */

$this->title = 'Create Jackpot Bet';
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-bet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form3', [
        'model' => $model,
    ]) ?>

</div>
