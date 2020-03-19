<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\JpbonusAward */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jpbonus Awards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jpbonus-award-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'jackpot_event_id',
            'jackpot_bonus',
            'scorepesa_points_bonus',
            'created_by',
            'created',
            'modified',
        ],
    ]) ?>

</div>
