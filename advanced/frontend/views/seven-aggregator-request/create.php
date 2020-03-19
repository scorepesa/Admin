<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SevenAggregatorRequest */

$this->title = 'Create Seven Aggregator Request';
$this->params['breadcrumbs'][] = ['label' => 'Seven Aggregator Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seven-aggregator-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
