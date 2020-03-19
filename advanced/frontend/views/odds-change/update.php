<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OddsChange */

$this->title = 'Update Odds Change: ' . $model->odds_change_id;
$this->params['breadcrumbs'][] = ['label' => 'Odds Changes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->odds_change_id, 'url' => ['view', 'id' => $model->odds_change_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="odds-change-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
