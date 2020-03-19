<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Summary';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-summary-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('index']);  ?>
    <a  href="<?php echo Url::to(['reportico-report/index']) ?>" class="btn btn-warning" role="button">Back to Reports</a>

    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'totalsubscribers',
            'deposits',
            'confirmedWithdrawals',
            'allwithdrawals',
            'virtualbalance',
            'virtualbonus',
            'timeline'
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
