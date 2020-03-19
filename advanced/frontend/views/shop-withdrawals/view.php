<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ShopWithdrawals */

$this->title = $model->withdrawal_id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Withdrawals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-withdrawals-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->withdrawal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->withdrawal_id], [
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
            'withdrawal_id',
            'msisdn',
            'amount',
            'created_by',
            'approved_by',
            'status',
            'created',
            'modified',
        ],
    ]) ?>

</div>
