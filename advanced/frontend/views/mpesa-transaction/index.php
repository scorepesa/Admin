<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MpesaTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'C2B Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#deposit">C2B Deposits</a></li>
    <li><a data-toggle="tab" href="#depositsftp">Upload C2B Deposits CSV</a></li>
</ul>

<div class="tab-content">
    <div id="deposit" class="tab-pane fade in active">
<!--        <p>
        <?php // Html::a('Create Deposit', ['create'], ['class' => 'btn btn-success']) ?>
        </p>-->
        <div class="mpesa-transaction-index">            
            <?php Pjax::begin(); ?>    <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                   // ['class' => 'yii\grid\SerialColumn'],
                    //'mpesa_transaction_id',
                    'msisdn',
                    'transaction_time',
                    //'message',
                    'account_no',
                    // 'mpesa_code',
                    'mpesa_amt',
                    'mpesa_sender',
                    'business_number',
                    // 'enc_params',
                    'created',
                    // 'modified',
                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?></div>

    </div>

    <div id="depositsftp" class="tab-pane fade">
        <!--upload file-->
        <?php
        $this->title = 'Upload C2B deposits excel';
        $this->params['breadcrumbs'][] = ['label' => 'C2B Deposits CSV', 'url' => ['index']];
        $this->params['breadcrumbs'][] = $this->title;
        ?>

        <p>
            <?= Html::a('Upload', ['uploadxls'], ['class' => 'btn btn-success']) ?>
        </p>
<!--
        <p>
            <?php // Html::a('Run Processor', ['runxls'], ['class' => 'btn btn-warning']) ?>
        </p>

        <p>
            <?php // Html::a('View Logs', ['logviewer'], ['class' => 'btn btn-primary']) ?>
        </p>
-->

        <!--<div class="mpesa-transaction-form">

        <?php
        //$form2 = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => ['mpesa-transaction/runxls'],]);
        ?>

            <div class="form-group">
        <?php // Html::submitButton('Run Excel Processor', ['class' => 'btn btn-primary']) ?>
            </div>

            <p>
        <?php //Html::a('Check Missed Deposits', ['logviewer'], ['class' => 'btn btn-warning']) ?>
            </p>

        <?php //ActiveForm::end(); ?>
        </div>-->

    </div>
</div>
