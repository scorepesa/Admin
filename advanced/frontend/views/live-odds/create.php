<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LiveOdds */

$this->title = 'Create Live Odds';
$this->params['breadcrumbs'][] = ['label' => 'Live Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-odds-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
