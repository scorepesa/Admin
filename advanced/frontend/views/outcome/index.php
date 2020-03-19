<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutcomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outcomes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outcome-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <div class="tab-content">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#normalOutcome">Bets</a></li>
            <li><a href="<?php echo Url::to(['outcome/create']) ?>">Create</a></li>
        </ul>

    <div id="normalOutcome" class="tab-pane fade in active">

            <!--
	    <p>
		<?= Html::a('Create Outcome', ['create'], ['class' => 'btn btn-success', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
	    </p>
	     <p>
		<?= Html::a('Create Live Outcome', ['create-live'], ['class' => 'btn btn-success', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
	    </p> -->

	    <p>
		<?= Html::a('Void Match', ['//bet-slip/voidmatch'], ['class' => 'btn btn-success', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
	    </p>
            <!--
	    <p>
		<?= Html::a('Void LiveMatch', ['//bet-slip/voidlivematch'], ['class' => 'btn btn-success', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
	    </p>
            -->

	    <p>
		<?= Html::a('Void Market', ['//bet-slip/voidmarket'], ['class' => 'btn btn-success', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
	    </p>
	    
	    <!--
	    <p>
		<?= Html::a('Void Live Market', ['//bet-slip/voidlivemarket'], ['class' => 'btn btn-success', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
	    </p>


	    <p>
		<?= Html::a('Outright Outcome', ['//outright-outcome/index'], ['class' => 'btn btn-success', 'data-toggle' => 'confirmation', 'data-placement' => "top"]) ?>
	    </p> --> 
            <p>
                <!--  <?= Html::a('Result VoidFactor', ['drawnobet'], ['class' => 'btn btn-success']) ?> -->
            </p>

	    <?php Pjax::begin(); ?>    <?=
	    GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
		    ['class' => 'yii\grid\SerialColumn'],
		    'match_result_id',
		    [
			'label' => 'Outcome Type',
			'format' => 'raw',
			'value' => function ($data) {
			    return Html::tag("a", "OutcomeType", ['href' => yii\helpers\Url::to(['odd-type/index']) . '?OddTypeSearch[sub_type_id]=' . $data->sub_type_id]);
			},
			    ],
			    'sub_type_id',
			    /*[
				'label' => 'Match',
				'format' => 'raw',
				'value' => function ($data) {
				    if($data->live_bet==1){
				    return Html::tag("a", "LiveMatch", ['href' => yii\helpers\Url::to(['live-match/index']) . '&LiveMatchSearch[parent_match_id]=' . $data->parent_match_id]);
				     }else{
				  return Html::tag("a", "Match", ['href' => yii\helpers\Url::to(['match/index']) . '&MatchSearch[parent_match_id]=' . $data->parent_match_id]);
				   }
				},
				    ],*/
				    'created_by',
				    'created',
				    ['attribute' => 'homeTeam', 'label' => 'Home Team'],
				    ['attribute' => 'awayTeam', 'label' => 'Away Team'],
				    'winning_outcome',
				    'live_bet',
				    'special_bet_value',
				    ['class' => 'yii\grid\ActionColumn'],
				],
			    ]);
			    ?>
			    <?php Pjax::end(); ?>
	</div>
</div>
</div>
