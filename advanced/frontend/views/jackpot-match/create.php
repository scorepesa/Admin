<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JackpotMatch */

$this->title = 'Create Jackpot Match';
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
