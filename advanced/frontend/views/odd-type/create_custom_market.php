<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OddType */

$this->title = 'Create Custom Market';
$this->params['breadcrumbs'][] = ['label' => 'Odd Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odd-type-create-custom-market">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_custom_form', [
        'model' => $model,
    ]) ?>

</div>
