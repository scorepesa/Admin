<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JackpotType */

$this->title = 'Create Jackpot Type';
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
