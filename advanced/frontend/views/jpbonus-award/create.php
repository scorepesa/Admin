<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\JpbonusAward */

$this->title = 'Create Jpbonus Award';
$this->params['breadcrumbs'][] = ['label' => 'Jpbonus Awards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jpbonus-award-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
