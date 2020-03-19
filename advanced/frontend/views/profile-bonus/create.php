<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProfileBonus */

$this->title = 'Create Profile Bonus';
$this->params['breadcrumbs'][] = ['label' => 'Profile Bonuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-bonus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
