<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotMatch */

$this->title = $model->jackpot_match_id;
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-match-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->jackpot_match_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->jackpot_match_id], [
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
            'jackpot_match_id',
            'parent_match_id',
            'status',
            'created_by',
            'created',
            'modified',
            'game_order',
        ],
    ])
    ?>

</div>
