<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPointTrx */

$this->title = 'Create Scorepesa Point Trx';
$this->params['breadcrumbs'][] = ['label' => 'Scorepesa Point Trxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scorepesa-point-trx-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
