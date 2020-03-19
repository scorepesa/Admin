<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OutrightCompetitor */

$this->title = 'Create Outright Competitor';
$this->params['breadcrumbs'][] = ['label' => 'Outright Competitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-competitor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
