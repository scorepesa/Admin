<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProfileBalance */

$this->title = 'Create Profile Balance';
$this->params['breadcrumbs'][] = ['label' => 'Profile Balances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
