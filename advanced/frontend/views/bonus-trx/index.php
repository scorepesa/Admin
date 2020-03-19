<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BonusTrxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bonus Trxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonus-trx-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <!--
        <p>
            //<?php // Html::a('Create Bonus Trx', ['create'], ['class' => 'btn btn-success'])  ?>
        </p>-->
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            'id',
            'profile_id',
            //'account',
            [
                 'label'=> 'DR/CR',
                 'attribute'=>'iscredit',
                 'value'=>function ($model, $key, $index, $widget) {
                     return $model->iscredit?'CR':'DR';
                 },
            ],

            'reference',
            'amount',
            [
                'label' => 'bonus bet',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::tag("a", "Bonus Bets", ['href' => yii\helpers\Url::to(['bonus-bet/index']) . '?BonusBetSearch[profile_bonus_id]=' . $data->profile_bonus_id]);
                },
                    ],
                    'created_by',
                    'created',
                    'modified',
                    'profile_bonus_id',
//            ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?></div>
