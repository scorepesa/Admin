<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AirtelMoney */

$this->title = 'Update Airtel Money: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Airtel Moneys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="airtel-money-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
