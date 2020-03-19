<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ShopDepositsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Deposits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-deposits-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Shop Deposits', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-info" href="<?php echo Url::to(['shop-withdrawals/create']) ?>">Create Shop Withdrawal</a>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'transaction_id',
            'msisdn',
            'code',
            'amount',
            'network',
            'depositor',
            'created_by',
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                        if ($model->status == 1){
                            $class = 'btn btn-success btn-sm';
                            $text = 'Approve';

                        }else {
                            $class = 'btn btn-default btn-sm disabled';
                            $text = 'Aprroved';
                        }

                        return Html::a(
                            $text,
                            Url::to(['shop-deposits/approvedeposit', 'id' => $model->transaction_id, 'approvedBy' => Yii::$app->user->identity->username]),
                            [
                                'id'=>'grid-custom-button',
                                'data-pjax'=>true,
                                'action'=>Url::to(['shop-deposits/approvedeposit', 'id' => $model->transaction_id]),
                                'class'=>[$class],
                                'data-toggle' => 'confirmation',
                                'label'=>[$text],
                            ]
                        );
                }
            ],
            'approved_by',
            'status',
            'created',
            'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
