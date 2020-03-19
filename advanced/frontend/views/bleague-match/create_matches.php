<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BleagueMatch */

$this->title = 'Create Bleague Match';
$this->params['breadcrumbs'][] = ['label' => 'Bleague Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bleague-match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_add_matches_form', [
        'model' => $model,
    ]) ?>

</div>
