<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BonusBet */

$this->title = 'Create Bonus Bet';
$this->params['breadcrumbs'][] = ['label' => 'Bonus Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonus-bet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
