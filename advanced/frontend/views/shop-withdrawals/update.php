<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ShopWithdrawals */

$this->title = 'Update Shop Withdrawals: ' . $model->withdrawal_id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Withdrawals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->withdrawal_id, 'url' => ['view', 'id' => $model->withdrawal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-withdrawals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
