<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BetSlip */

$this->title = 'Create Bet Slip';
$this->params['breadcrumbs'][] = ['label' => 'Bet Slips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bet-slip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
