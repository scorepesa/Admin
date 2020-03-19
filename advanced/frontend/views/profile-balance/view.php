<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileBalance */

$this->title = $model->profile_balance_id;
$this->params['breadcrumbs'][] = ['label' => 'Profile Balances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-balance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->profile_balance_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->profile_balance_id], [
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
            'profile_balance_id',
            'profile_id',
            'balance',
            'transaction_id',
            'created',
            'modified',
        ],
    ]) ?>

</div>
