<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AirtelMoneySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Airtel Moneys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airtel-money-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php
    // echo $this->render('_search', ['model' => $searchModel]);  
/*    echo '<div class="col-md-4 pull-right">';
    echo Editable::widget([
        'preHeader' => '',
        'name' => 'airtel_file',
        'asPopover' => true,
        'displayValue' => 'Upload Airtel file',
        'header' => 'Upload Airtel file',
        'submitOnEnter' => false,
        'inputType' => Editable::INPUT_HIDDEN,
        'size' => 'lg',
        'type' => PopoverX::TYPE_INFO,
        'placement' => PopoverX::ALIGN_BOTTOM,
        'format' => 'button',
        'formOptions' => [
            'action' => ['airtel-money/upload-airtelxls'],
        ],
        'editableButtonOptions' => ['label' => '<i class="glyphicon glyphicon-upload"></i>'],
        'beforeInput' => function () {
    return $this->render('_form_upload_airtel');
},
    ]);
    echo '</div>';*/
    ?>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'msisdn',
            'account_no',
            'airtel_money_code',
            'first_name',
            // 'last_name',
            // 'amount',
            // 'time_stamp',
            // 'created',
            // 'modified',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
