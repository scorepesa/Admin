<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Talksport */

$this->title = $model->talksport_id;
$this->params['breadcrumbs'][] = ['label' => 'Talksports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talksport-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->talksport_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->talksport_id], [
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
            'talksport_id',
            'parent_match_id',
            'stream_url:url',
            'created',
            'modified',
        ],
    ]) ?>

</div>
