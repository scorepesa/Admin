<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserBetCancel */

$this->title = 'Award Jackpot Bonus';
$this->params['breadcrumbs'][] = ['label' => 'Award Jackpot Bonus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="award-jackpot-bonus">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_award_jackpot_bonus_form', [
        'model' => $model,
    ]) ?>

</div>
