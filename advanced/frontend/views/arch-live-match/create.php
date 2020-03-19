<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArchLiveMatch */

$this->title = 'Create Arch Live Match';
$this->params['breadcrumbs'][] = ['label' => 'Arch Live Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arch-live-match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
