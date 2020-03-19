<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScorepesaPointTrxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scorepesa Point Trxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scorepesa-point-trx-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
    <?php // Html::a('Create Scorepesa Point Trx', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'scorepesa_point_trx_id',
            'created',
            ['label' => 'TransactionId', 'attribute' => 'trx_id'],
            'points',
            'trx_type',
            'status'
        // 'modified',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
