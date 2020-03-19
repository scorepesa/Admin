<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile Balances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-balance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'profile_balance_id',
            'profile_id',
            'balance',
            'bonus_balance',
            'transaction_id',
            'created',
            'modified',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?></div>
