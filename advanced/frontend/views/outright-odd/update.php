<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightOdd */

$this->title = 'Update Outright Odd: ' . $model->odd_id;
$this->params['breadcrumbs'][] = ['label' => 'Outright Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->odd_id, 'url' => ['view', 'id' => $model->odd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outright-odd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
