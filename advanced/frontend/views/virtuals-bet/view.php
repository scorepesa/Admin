<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VirtualsBet */

$this->title = $model->bet_id;
$this->params['breadcrumbs'][] = ['label' => 'Virtuals Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtuals-bet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bet_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bet_id], [
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
            'bet_id',
            'profile_id',
            'bet_message:ntext',
            'total_odd',
            'bet_amount',
            'possible_win',
            'status',
            'win',
            'reference',
            'created_by',
            'created',
            'modified',
        ],
    ]) ?>

</div>
