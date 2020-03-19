<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotType */

$this->title = 'Update Jackpot Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->jackpot_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jackpot-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
