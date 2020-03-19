<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountFreeze */

$this->title = 'Create Account Freeze';
$this->params['breadcrumbs'][] = ['label' => 'Account Freezes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-freeze-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
