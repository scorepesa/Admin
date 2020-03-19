<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BleagueCompetition */

$this->title = 'Create Bleague Competition';
$this->params['breadcrumbs'][] = ['label' => 'Bleague Competitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bleague-competition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
