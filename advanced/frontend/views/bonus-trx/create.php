<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BonusTrx */

$this->title = 'Create Bonus Trx';
$this->params['breadcrumbs'][] = ['label' => 'Bonus Trxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonus-trx-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
