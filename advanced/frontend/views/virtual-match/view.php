<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualMatch */

$this->title = $model->v_match_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtual Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtual-match-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->v_match_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->v_match_id], [
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
            'v_match_id',
            'parent_virtual_id',
            'home_team',
            'away_team',
            'start_time',
            'competition_id',
            'status',
            'instance_id',
            'bet_closure',
            'created_by',
            'created',
            'modified',
            'result',
            'ht_score',
            'ft_score',
            'completed',
            'priority',
        ],
    ]) ?>

</div>
