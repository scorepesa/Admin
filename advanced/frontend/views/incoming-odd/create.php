<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IncomingOdd */

$this->title = 'Create Incoming Odd';
$this->params['breadcrumbs'][] = ['label' => 'Incoming Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incoming-odd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
