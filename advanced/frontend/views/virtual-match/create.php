<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VirtualMatch */

$this->title = 'Create Virtual Match';
$this->params['breadcrumbs'][] = ['label' => 'Virtual Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtual-match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
