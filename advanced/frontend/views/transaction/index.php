<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            'id',
            'profile_id',
            'profile.msisdn',
           // 'account',
            [
                 'label'=> 'DR/CR',
                 'attribute'=>'iscredit',
                 'value'=>function ($model, $key, $index, $widget) {
                     return $model->iscredit?'CR':'DR';
                 },
            ],
            ['attribute'=>'reference', 'label'=>"Reference", 'width'=>"150px"],
            'amount',
            'running_balance',
            'created_by',
            //'created',
             'modified',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
