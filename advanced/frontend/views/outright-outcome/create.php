<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OutrightOutcome */

$this->title = 'Create Outright Outcome';
$this->params['breadcrumbs'][] = ['label' => 'Outright Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-outcome-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
