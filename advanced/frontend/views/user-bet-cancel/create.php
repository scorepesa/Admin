<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserBetCancel */

$this->title = 'Cancel Bet';
$this->params['breadcrumbs'][] = ['label' => 'Cancel Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bet-cancel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
