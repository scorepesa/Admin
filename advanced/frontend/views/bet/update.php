<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bet */

$this->title = 'Update Bet: ' . $model->bet_id;
$this->params['breadcrumbs'][] = ['label' => 'Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bet_id, 'url' => ['view', 'id' => $model->bet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
