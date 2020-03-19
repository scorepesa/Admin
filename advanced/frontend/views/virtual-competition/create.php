<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VirtualCompetition */

$this->title = 'Create Virtual Competition';
$this->params['breadcrumbs'][] = ['label' => 'Virtual Competitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtual-competition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
