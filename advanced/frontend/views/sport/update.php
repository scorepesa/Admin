<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sport */

$this->title = 'Update Sport: ' . $model->sport_id;
$this->params['breadcrumbs'][] = ['label' => 'Sports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sport_id, 'url' => ['view', 'id' => $model->sport_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sport-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
