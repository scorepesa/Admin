<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ShopDeposits */

$this->title = 'Update Shop Deposits: ' . $model->transaction_id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transaction_id, 'url' => ['view', 'id' => $model->transaction_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-deposits-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
