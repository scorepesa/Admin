<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ShopDeposits */

$this->title = $model->transaction_id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-deposits-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->transaction_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->transaction_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'transaction_id',
            'msisdn',
            'code',
            'amount',
            'network',
            'depositor',
            'created_by',
            'approved_by',
            'status',
            'created',
            'modified',
        ],
    ]) ?>

</div>
