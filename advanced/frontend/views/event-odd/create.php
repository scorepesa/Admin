<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MatchBet */

$this->title = 'Create Event Odd';
$this->params['breadcrumbs'][] = ['label' => 'Match Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-bet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'disabled' => 'data-id'
    ])
    ?>

</div>
