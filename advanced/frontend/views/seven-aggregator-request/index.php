<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SevenAggregatorRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seven Aggregator Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seven-aggregator-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'date_created',
            'amount',
            'request_name',
//            'amount_small',
            'currency',
            ['label' => 'MSISDN', 'attribute' => 'profileName'],
            'payment_strategy',
            // 'transactionType',
            'payment_id',
            // 'transaction_id',
            // 'source_id',
            'reference_id',
            // 'tp_token:ntext',
            'ticket_info:ntext',
            // 'security_hash',
            // 'club_uuid',
            // 'status',
            'aggregator_status',
            'created_by'
        // 'date_modified',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
