<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileSettings */

$this->title = 'Update Profile Settings: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Profile Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->profile_setting_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profile-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
