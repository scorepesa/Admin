<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OddType */

$this->title = 'Update Odd Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Odd Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->bet_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="odd-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
