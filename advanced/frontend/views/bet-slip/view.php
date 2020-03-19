<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BetSlip */

$this->title = $model->bet_slip_id;
$this->params['breadcrumbs'][] = ['label' => 'Bet Slips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bet-slip-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bet_slip_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bet_slip_id',
            'parent_match_id',
            'bet_id',
            'bet_pick',
            'total_games',
            'odd_value',
            'win',
            'created',
            'modified',
            'status',
            'sub_type_id',
        ],
    ])
    ?>

</div>
