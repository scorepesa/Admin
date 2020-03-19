<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OddsChange */

$this->title = 'Create Odds Change';
$this->params['breadcrumbs'][] = ['label' => 'Odds Changes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odds-change-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
