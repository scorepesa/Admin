<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShopWithdrawalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Withdrawals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-withdrawals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Shop Withdrawals', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-info" href="<?php echo Url::to(['shop-deposits/create']) ?>">Create Shop Deposit</a>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'withdrawal_id',
            'msisdn',
            'amount',
            'created_by',
            'approved_by',
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                        if ($model->status == 1){
                            $class = 'btn btn-success btn-sm';
                            $text = 'Approve';

                        }elseif($model->status == 7) {
                            $class = 'btn btn-danger btn-sm disabled';
                            $text = 'Insufficient';
                        }else {
                            $class = 'btn btn-default btn-sm disabled';
                            $text = 'Successful';
                        }

                        return Html::a(
                            $text,
                            Url::to(['shop-withdrawals/approvewithdrawal', 'id' => $model->withdrawal_id, 'approvedBy' => Yii::$app->user->identity->username]),
                            [
                                'id'=>'grid-custom-button',
                                'data-pjax'=>true,
                                'action'=>Url::to(['shop-withdrawals/approvewithdrawal', 'id' => $model->withdrawal_id]),
                                'class'=>[$class],
                                'data-toggle' => 'confirmation',
                                'label'=>[$text],
                            ]
                        );
                }
            ],

            'status',
            'created',
            'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
