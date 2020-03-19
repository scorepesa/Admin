<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileBalance */

$this->title = 'Update Profile Balance: ' . $model->profile_balance_id;
$this->params['breadcrumbs'][] = ['label' => 'Profile Balances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->profile_balance_id, 'url' => ['view', 'id' => $model->profile_balance_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profile-balance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
