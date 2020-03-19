<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileBonus */

$this->title = 'Update Profile Bonus: ' . $model->profile_bonus_id;
$this->params['breadcrumbs'][] = ['label' => 'Profile Bonuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->profile_bonus_id, 'url' => ['view', 'id' => $model->profile_bonus_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profile-bonus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
