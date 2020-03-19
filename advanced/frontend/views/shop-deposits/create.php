<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ShopDeposits */

$this->title = 'Create Shop Deposits';
$this->params['breadcrumbs'][] = ['label' => 'Shop Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-deposits-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
