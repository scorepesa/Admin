<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OutrightCompetitor */

$this->title = 'Update Outright Competitor: ' . $model->competitor_id;
$this->params['breadcrumbs'][] = ['label' => 'Outright Competitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->competitor_id, 'url' => ['view', 'id' => $model->competitor_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outright-competitor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
