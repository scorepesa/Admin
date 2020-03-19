<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\tableexport\ButtonTableExport;

/* @var $this yii\web\View */
/* @var $model app\models\Outbox */

$this->title = $model->outbox_id;
$this->params['breadcrumbs'][] = ['label' => 'Outboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?=
ButtonTableExport::widget(
        [
            'label' => 'Export Table',
            'selector' => '#tableId', // any jQuery selector
            'exportClientOptions' => [
                'ignoredColumns' => [0, 7],
                'useDataUri' => false,
                'url' => \yii\helpers\Url::to('controller/download')
            ]
        ]
);
?>

<div class="outbox-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->outbox_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->outbox_id], [
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
            'outbox_id',
            'shortcode',
            'network',
            'profile_id',
            'linkid',
            'date_created',
            'date_sent',
            'retry_status',
            'modified',
            'text:ntext',
            'msisdn',
        ],
    ])
    ?>

</div>
