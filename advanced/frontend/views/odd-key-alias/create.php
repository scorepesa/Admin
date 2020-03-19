<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OddKeyAlias */

$this->title = 'Create Odd Key Alias';
$this->params['breadcrumbs'][] = ['label' => 'Odd Key Aliases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odd-key-alias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
