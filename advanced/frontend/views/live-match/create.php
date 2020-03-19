<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LiveMatch */

$this->title = 'Create Live Match';
$this->params['breadcrumbs'][] = ['label' => 'Live Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
