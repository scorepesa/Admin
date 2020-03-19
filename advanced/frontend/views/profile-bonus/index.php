<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileBonusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile Bonuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-bonus-index">

<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

<div ><?= Html::a('Award Bonus', ['create'. '?ProfileBonusSearch[profile_id]='.$dataProvider->query->where['profile_id']], ['class' => 'btn btn-primary']) ?></div>

<?php Pjax::begin(); ?>    <?=
GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
		// ['class' => 'yii\grid\SerialColumn'],
		['attribute'=>'profile_bonus_id','label'=>'ID'],
		'profile_id',
		'referred_msisdn',
		'bonus_amount',
		[
		'label' => 'bonus bet',
		'format' => 'raw',
		'value' => function ($data) {
		return Html::tag("a", "Bonus Bets", ['href' => yii\helpers\Url::to(['bonus-bet/index']) . '&BonusBetSearch[profile_bonus_id]=' . $data->profile_bonus_id]);
		},
		],
		['attribute'=>'created_by','label'=>'Source', 'width'=>'150px'],
		'date_created',
		'updated',
		'expiry_date',
		'status',
		['attribute'=>'bet_on_status',
		'label'=>'Bet On', 
		'value'=>function($model, $key, $index, $widget) {
                     return $model->bet_on_status == 2?'YES':'NO';
                 }],
		//['class' => 'yii\grid\ActionColumn'],
		],
		]);
?>
<?php Pjax::end(); ?></div>
