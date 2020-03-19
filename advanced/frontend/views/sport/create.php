<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sport */

$this->title = 'Create Sport';
$this->params['breadcrumbs'][] = ['label' => 'Sports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
