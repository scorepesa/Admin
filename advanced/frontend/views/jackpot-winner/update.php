<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotWinner */

$this->title = 'Update Jackpot Winner: ' . $model->jackpot_winner_id;
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Winners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jackpot_winner_id, 'url' => ['view', 'id' => $model->jackpot_winner_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jackpot-winner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form3', [
        'model' => $model,
    ]) ?>

</div>
