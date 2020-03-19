<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Withdrawal */

$this->title = 'Update Withdrawal: ' . $model->withdrawal_id;
$this->params['breadcrumbs'][] = ['label' => 'Withdrawals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->withdrawal_id, 'url' => ['view', 'id' => $model->withdrawal_id]];
$this->params['breadcrumbs'][] = 'Update';

if ($model->status=='FAILED' or $model->status=='SENT' or  $model->status=='TRX_SUCCESS') {

?>
<div class="withdrawal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
 }
?>
