<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MpesaTransaction */

$this->title = 'Create Mpesa Transaction';
$this->params['breadcrumbs'][] = ['label' => 'Mpesa Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpesa-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
