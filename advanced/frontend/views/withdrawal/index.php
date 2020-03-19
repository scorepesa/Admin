<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WithdrawalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Withdrawals';
$this->params['breadcrumbs'][] = $this->title;
?>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#withdraw">Withdrawals List</a></li>
    <li><a data-toggle="tab" href="#apilog">Mpesa API Response</a></li>
</ul>

<div class="tab-content">    
    <div class="tab-content">
        <div id="withdraw" class="tab-pane fade in active">
            <div class="withdrawal-index">
                <h1><?= Html::encode($this->title) ?></h1>

                <?php Pjax::begin(); ?>    <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                       // ['class' => 'yii\grid\SerialColumn'],
                        'withdrawal_id',
                        'network',
                        'msisdn',
                       # 'raw_text',
                        'amount',
                        ['attribute'=>'reference', 'width'=>'300px'],
                        'created',
                        // 'created_by',
                        'status',
                        // 'provider_reference',
                        //'number_of_sends',
                        'charge',
                        // 'max_withdraw',
                        //if (Yii::$app->user->identity->username == 'results_admin'):
                        ['class' => 'yii\grid\ActionColumn'],
                    //endif;
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>
            </div>
        </div>

        <div id="apilog" class="tab-pane fade in">

        </div>
    </div>
