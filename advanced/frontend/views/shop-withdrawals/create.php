<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ShopWithdrawals */

$this->title = 'Create Shop Withdrawals';
$this->params['breadcrumbs'][] = ['label' => 'Shop Withdrawals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-withdrawals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
