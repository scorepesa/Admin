<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\IncomingMatch */

$this->title = $model->incoming_match_id;
$this->params['breadcrumbs'][] = ['label' => 'Incoming Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incoming-match-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->incoming_match_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->incoming_match_id], [
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
            'incoming_match_id',
            'parent_match_id',
            'sport_name',
            'competition_name',
            'competition_category',
            'start_time',
            'end_time',
            'home_team',
            'away_team',
            'home_odd',
            'neutral_odd',
            'away_odd',
            'created',
        ],
    ]) ?>

</div>
