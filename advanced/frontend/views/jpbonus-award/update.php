<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\JpbonusAward */

$this->title = 'Update Jpbonus Award: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jpbonus Awards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jpbonus-award-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
