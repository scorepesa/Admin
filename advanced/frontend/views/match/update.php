<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Match */

$this->title = 'Update Match: ' . $model->match_id;
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->match_id, 'url' => ['view', 'id' => $model->match_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="match-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
