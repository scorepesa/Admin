<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OddsChange */

$this->title = $model->odds_change_id;
$this->params['breadcrumbs'][] = ['label' => 'Odds Changes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odds-change-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->odds_change_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->odds_change_id], [
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
            'odds_change_id',
            'parent_match_id:ntext',
            'subtype:ntext',
            'key:ntext',
            'value:ntext',
            'match_time:ntext',
            'score:ntext',
            'bet_status:ntext',
            'created',
        ],
    ]) ?>

</div>
