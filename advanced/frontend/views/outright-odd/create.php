<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OutrightOdd */

$this->title = 'Create Outright Odd';
$this->params['breadcrumbs'][] = ['label' => 'Outright Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outright-odd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
