<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MpesaTransaction */

$this->title = $model->mpesa_transaction_id;
$this->params['breadcrumbs'][] = ['label' => 'Mpesa Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpesa-transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->mpesa_transaction_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->mpesa_transaction_id], [
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
            'mpesa_transaction_id',
            'msisdn',
            'transaction_time',
            'message',
            'account_no',
            'mpesa_code',
            'mpesa_amt',
            'mpesa_sender',
            'business_number',
            'enc_params',
            'created',
            'modified',
        ],
    ]) ?>

</div>
