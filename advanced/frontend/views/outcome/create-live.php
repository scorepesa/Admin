<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Outcome */

$this->title = 'Create Live Bet Outcome';
$this->params['breadcrumbs'][] = ['label' => 'Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outcome-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_live', [
        'model' => $model,
    ]) ?>

</div>
