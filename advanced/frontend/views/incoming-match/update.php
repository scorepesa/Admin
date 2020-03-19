<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IncomingMatch */

$this->title = 'Update Incoming Match: ' . $model->incoming_match_id;
$this->params['breadcrumbs'][] = ['label' => 'Incoming Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->incoming_match_id, 'url' => ['view', 'id' => $model->incoming_match_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incoming-match-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
