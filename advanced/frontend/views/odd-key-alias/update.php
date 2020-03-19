<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OddKeyAlias */

$this->title = 'Update Odd Key Alias: ' . $model->odd_key_alias_id;
$this->params['breadcrumbs'][] = ['label' => 'Odd Key Aliases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->odd_key_alias_id, 'url' => ['view', 'id' => $model->odd_key_alias_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="odd-key-alias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
