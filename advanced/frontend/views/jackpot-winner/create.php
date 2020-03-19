<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotWinner */

$this->title = 'Crefit Jackpot Winners';
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Winners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-winner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form3', [
        'model' => $model,
        'jpmatch_model' => $jpmatch_model
    ])
    ?>

</div>
