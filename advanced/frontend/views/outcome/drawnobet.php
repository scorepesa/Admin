<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Outcome */

$this->title = 'Draw No Bet';
$this->params['breadcrumbs'][] = ['label' => 'Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outcome-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_result_draw_no_bet_form', [
        'model' => $model,
    ]) ?>

</div>

