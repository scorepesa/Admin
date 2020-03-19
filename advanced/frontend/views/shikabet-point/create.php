<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ScorepesaPoint */

$this->title = 'Create Scorepesa Point';
$this->params['breadcrumbs'][] = ['label' => 'Scorepesa Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scorepesa-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
