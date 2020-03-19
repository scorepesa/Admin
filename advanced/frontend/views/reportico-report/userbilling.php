<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Billing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-billing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <a  href="<?php echo Url::to(['reportico-report/index']) ?>" class="btn btn-warning" role="button">Back to Reports</a>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'msisdn',
            'balance',
            'lasttopup',
            'lastWithdraw',
            'multibets',
            'singlebets',
            'source',
            'joined'
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
