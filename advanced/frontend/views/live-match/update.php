<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LiveMatch */

$this->title = 'Update Live Match: ' . $model->match_id;
$this->params['breadcrumbs'][] = ['label' => 'Live Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->match_id, 'url' => ['view', 'id' => $model->match_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="live-match-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
