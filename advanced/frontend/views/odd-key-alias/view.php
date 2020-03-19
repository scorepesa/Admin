<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OddKeyAlias */

$this->title = $model->odd_key_alias_id;
$this->params['breadcrumbs'][] = ['label' => 'Odd Key Aliases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odd-key-alias-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->odd_key_alias_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->odd_key_alias_id], [
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
            'odd_key_alias_id',
            'sub_type_id',
            'odd_key',
            'odd_key_alias',
            'special_bet_value',
        ],
    ]) ?>

</div>
