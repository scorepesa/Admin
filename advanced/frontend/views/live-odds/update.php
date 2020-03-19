<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LiveOdds */

$this->title = 'Update Live Odds: ' . $model->live_odds_id;
$this->params['breadcrumbs'][] = ['label' => 'Live Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->live_odds_id, 'url' => ['view', 'id' => $model->live_odds_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="live-odds-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
