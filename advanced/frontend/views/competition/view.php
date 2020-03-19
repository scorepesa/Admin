<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Competition */

$this->title = $model->competition_id;
$this->params['breadcrumbs'][] = ['label' => 'Competitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="competition-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->competition_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->competition_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'competition_id',
            'competition_name',
            'betradar_competition_id',
            'category',
            'category_id',
            'status',
            'sport_id',
            'created_by',
            'created',
            'modified',
            'priority',
            'ussd_priority',
            'max_stake',
            'alias',
        ],
    ]) ?>

</div>
