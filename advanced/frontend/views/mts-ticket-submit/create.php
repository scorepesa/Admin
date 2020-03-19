<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MtsTicketSubmit */

$this->title = 'Create Mts Ticket Submit';
$this->params['breadcrumbs'][] = ['label' => 'Mts Ticket Submits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mts-ticket-submit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
