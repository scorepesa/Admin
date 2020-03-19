<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualMatch */

$this->title = 'Update Virtual Match: ' . $model->v_match_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtual Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->v_match_id, 'url' => ['view', 'id' => $model->v_match_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="virtual-match-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
