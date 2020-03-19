<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Outright */

$this->title = 'Create Outright';
$this->params['breadcrumbs'][] = ['label' => 'Outrights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
