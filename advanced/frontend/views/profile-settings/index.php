<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-settings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],
        //    'profile_setting_id',
	    'created_at',
            'profile_id',
            'name',
            'max_stake',
	    'single_bet_max_stake',
	    'multibet_bet_max_stake',
	    'max_daily_possible_win',
            //'balance',
            //'status',
        // 'name',
        // 'reference_id',
        // 'created_at',
        // 'updated_at',
        // 'password:ntext',
        // 'max_stake',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?></div>
