<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bet */

$this->title = $model->bet_id;
$this->params['breadcrumbs'][] = ['label' => 'Bets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bet_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bet_id',
            'profile_id',
            'bet_message',
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
    ])
    ?>

</div>
