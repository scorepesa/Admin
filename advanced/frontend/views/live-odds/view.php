<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LiveOdds */

$this->title = $model->live_odds_id;
$this->params['breadcrumbs'][] = ['label' => 'Live Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-odds-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->live_odds_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->live_odds_id], [
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
            'live_odds_id',
            'parent_match_id',
            'home_odd',
            'neutral_odd',
            'away_odd',
            'created',
        ],
    ]) ?>

</div>
