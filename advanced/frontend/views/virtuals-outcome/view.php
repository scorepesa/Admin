<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsOutcome */

$this->title = $model->match_result_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtuals Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-outcome-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->match_result_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->match_result_id], [
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
            'match_result_id',
            'sub_type_id',
            'parent_match_id',
            'special_bet_value',
            'live_bet',
            'created_by',
            'created',
            'modified',
            'status',
            'approved_by',
            'approved_status',
            'date_approved',
            'winning_outcome',
        ],
    ]) ?>

</div>
