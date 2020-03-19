<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JackpotTrx */

$this->title = 'Create Jackpot Trx';
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Trxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-trx-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form3', [
        'model' => $model,
    ]) ?>

</div>
