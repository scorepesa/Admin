<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OddType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Odd Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odd-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bet_type_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bet_type_id], [
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
            'bet_type_id',
            'name',
            'created_by',
            'created',
            'modified',
            'sub_type_id',
        ],
    ]) ?>

</div>
