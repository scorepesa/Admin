<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Talksport */

$this->title = 'Create Talksport';
$this->params['breadcrumbs'][] = ['label' => 'Talksports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talksport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
