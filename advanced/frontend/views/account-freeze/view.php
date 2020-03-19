<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccountFreeze */

$this->title = $model->account_freeze_id;
$this->params['breadcrumbs'][] = ['label' => 'Account Freezes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-freeze-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->account_freeze_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->account_freeze_id], [
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
            'account_freeze_id',
            'msisdn',
            'status',
            'created',
            'modified',
        ],
    ]) ?>

</div>
