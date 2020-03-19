<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VirtualEventOdd */

$this->title = 'Create Virtual Event Odd';
$this->params['breadcrumbs'][] = ['label' => 'Virtual Event Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtual-event-odd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
