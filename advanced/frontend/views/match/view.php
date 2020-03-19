<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Match */

$this->title = $model->match_id;
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->match_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->match_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'match_id',
            'home_team',
            'away_team',
            'start_time',
            'game_id',
            'parent_match_id:ntext',
            'competition_id',
            'priority',
            'status',
            'bet_closure',
            'created_by',
            'created',
            'modified',
//            'match_result',
            'result',
            'result',
            'completed',
        ],
    ])
    ?>

</div>
