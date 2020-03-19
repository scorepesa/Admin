<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccountFreeze */

$this->title = 'Update Account Freeze: ' . $model->account_freeze_id;
$this->params['breadcrumbs'][] = ['label' => 'Account Freezes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->account_freeze_id, 'url' => ['view', 'id' => $model->account_freeze_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-freeze-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
