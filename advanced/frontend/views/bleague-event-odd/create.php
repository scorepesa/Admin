<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BleagueEventOdd */

$this->title = 'Create Bleague Event Odd';
$this->params['breadcrumbs'][] = ['label' => 'Bleague Event Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bleague-event-odd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
