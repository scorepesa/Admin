<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);    ?>
<ul class="nav nav-tabs">
<li class="active"><a data-toggle="tab" href="#">Profiles</a></li>
<li><a href="<?php echo Url::to(['account-freeze/index']) ?>">Account Freeze</a></li>
<li><a href="<?php echo Url::to(['transaction/manualtrx']) ?>">Credit Account</a></li>
</ul>

<?php
$gridColumns = [
//        ['class' => 'yii\grid\SerialColumn'],
[
'attribute' => 'profile_id',
	'vAlign' => 'middle',
	'format' => 'raw',
	'noWrap' => true,
	'label' =>'ID'
	],
	'created',
	[
	'attribute' => 'msisdn',
	'vAlign' => 'middle',
	'format' => 'raw',
	'width' => '150px',
	'noWrap' => true
        ],
	[
	'label' => 'Balance',
	'format' => 'raw',
	'attribute' => 'profileBalance.balance'
	],
	['attribute'=>'status', 
	'value' => function ($model, $key, $index, $widget) {
		return $model->status== 1?'ACTIVE':($model->status==2? 'FREEZE':'INACTIVE');
         },

	],
	[
	'label' => 'transactions',
	'format' => 'raw',
	'value' => function ($data) {
		return Html::tag("a", "transactions", ['href' => yii\helpers\Url::to(['transaction/index']) . '?&TransactionSearch[profile_id]=' . $data->profile_id]);
	},
	],
	[
	'label' => 'bonus transactions',
	'format' => 'raw',
	'value' => function ($data) {
		return Html::tag("a", "bonus transactions", ['href' => yii\helpers\Url::to(['bonus-trx/index']) . '?&BonusTrxSearch[profile_id]=' . $data->profile_id]);
	},
	],
        [
	'label' => 'profileSettings',
	'format' => 'raw',
	'value' => function ($data) {
		return Html::tag("a", "profile_settings", ['href' => yii\helpers\Url::to(['profile-settings/index']) . '?&ProfileSettingsSearch[profile_id]=' . $data->profile_id]);
	},
	],
	[
	'label' => 'ProfileBonus',
	'format' => 'raw',
	'value' => function ($data) {
		return Html::tag("a", "Bonus Award", ['href' => yii\helpers\Url::to(['profile-bonus/index']) . '?&ProfileBonusSearch[profile_id]=' . $data->profile_id]);
	},
	],
/**	[
	'label' => 'ScorepesaPoints',
	'format' => 'raw',
	'value' => function ($data) {
		return Html::tag("a", "Scorepesa Point", ['href' => yii\helpers\Url::to(['scorepesa-point/index']) . '?&ScorepesaPointSearch[profile_id]=' . $data->profile_id]);
	},
	],
	[
	'label' => 'ScorepesaPointsTrx',
	'format' => 'raw',
	'value' => function ($data) {
		return Html::tag("a", "Points Trx", ['href' => yii\helpers\Url::to(['scorepesa-point-trx/index']) . '?&ScorepesaPointTrxSearch[profileId]=' . $data->profile_id]);
	},
	], **/
	//                    'balance',
	// 'created_by',
	// 'network',
	//                                    ['class' => 'yii\grid\ActionColumn'],
	];

	echo GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => $gridColumns,
			//                                                        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
			'beforeHeader' => [
			[
			'columns' => [
			['content' => 'Bet profiles details', 'options' => ['colspan' => 9, 'class' => 'text-center warning']],
			],
			'options' => ['class' => 'skip-export'] // remove this row from export
			]
			],
			'toolbar' => [
			['content' =>
			//                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
			Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
			],
			'{export}',
			'{toggleData}'
			],
			'pjax' => true,
			'bordered' => true,
			'striped' => true,
			'condensed' => true,
			'responsive' => true,
			'hover' => true,
			'floatHeader' => true,
			'floatHeaderOptions' => ['scrollingTop' => 10],
			'showPageSummary' => false,
#'panel' => [
#    'type' => GridView::TYPE_PRIMARY
#],
			]);
?>
</div>
