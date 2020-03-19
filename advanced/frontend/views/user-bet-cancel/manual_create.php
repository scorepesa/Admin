<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserBetCancel */

$this->title = 'Cancel Bets';
$this->params['breadcrumbs'][] = ['label' => 'User Bet Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bet-cancel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_user_bet_cancel_form', [
        'model' => $model,
    ]) ?>

</div>
