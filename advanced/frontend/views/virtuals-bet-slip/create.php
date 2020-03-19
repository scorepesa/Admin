<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VirtualsBetSlip */

$this->title = 'Create Virtuals Bet Slip';
$this->params['breadcrumbs'][] = ['label' => 'Virtuals Bet Slips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-bet-slip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
