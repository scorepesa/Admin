<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IncomingMatch */

$this->title = 'Create Incoming Match';
$this->params['breadcrumbs'][] = ['label' => 'Incoming Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incoming-match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
