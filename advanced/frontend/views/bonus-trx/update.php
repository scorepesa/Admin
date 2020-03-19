<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BonusTrx */

$this->title = 'Update Bonus Trx: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bonus Trxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bonus-trx-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
