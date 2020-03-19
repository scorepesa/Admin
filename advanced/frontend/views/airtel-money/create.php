<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AirtelMoney */

$this->title = 'Create Airtel Money';
$this->params['breadcrumbs'][] = ['label' => 'Airtel Moneys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airtel-money-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
