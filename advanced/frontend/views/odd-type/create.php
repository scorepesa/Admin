<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OddType */

$this->title = 'Create Odd Type';
$this->params['breadcrumbs'][] = ['label' => 'Odd Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odd-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
