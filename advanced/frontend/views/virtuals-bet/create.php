<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VirtualsBet */

$this->title = 'Create Virtuals Bet';
$this->params['breadcrumbs'][] = ['label' => 'Virtuals Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-bet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
