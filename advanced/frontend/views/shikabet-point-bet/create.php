<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPointBet */

$this->title = 'Create Scorepesa Point Bet';
$this->params['breadcrumbs'][] = ['label' => 'Scorepesa Point Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scorepesa-point-bet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
