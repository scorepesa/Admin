<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use frontend\assets\CopyClipboardAsset;

CopyClipboardAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\MatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Active Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    new Clipboard('.btn');
</script>
<div class="match-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>
    <?php
    function ($model, $key, $index) {
        return $this->render('send-daily-match', ['model' => $model]);
    };
//    echo $stub;
    ?>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#match">Create match</a></li>
        <li><a data-toggle="tab" href="#dailymatch">Daily matches</a></li>
        <li><a href="<?php echo Url::to(['odd-key-alias/index']) ?>">Odd Key Alias</a></li>
        <!--<li><a href="<?php // echo Url::to(['live-odds/index'])                 ?>">Live Odds</a></li>-->
        <li><a href="<?php echo Url::to(['competition/index']) ?>">Competition</a></li>
        <li><a href="<?php echo Url::to(['sport/index']) ?>">Sport</a></li>
        <li><a href="<?php echo Url::to(['live-match/index']) ?>">Live Matches</a></li>
        <!-- <li><a href="<?php echo Url::to(['virtual-match/index']) ?>">Virtuals Matches</a></li>
        <li><a href="<?php echo Url::to(['talksport/index']) ?>">Talksport Map</a></li> -->
        <li>

        </li>
    </ul>

    <div class="tab-content">
        <div id="match" class="tab-pane fade in active">
            <p>
                <?= Html::a('Create Match', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div id="dailymatch" class="tab-pane fade">

            <!-- Target -->
            <textarea id="bar" rows="10" cols="96"><?php
                foreach ($model->dailyShareMatches() as $value) {
                    echo $value . "\n\n";
                };
                ?></textarea>


            <div class="form-group">
                <div class="col-sm-offset-7 col-sm-10">
                    <!-- Trigger -->
                    <button class="btn btn-info" data-clipboard-action="cut" data-clipboard-target="#bar">
                        Cut to clipboard
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'match_id',
            'home_team',
            'away_team',
            'start_time',
            'settled',
            'priority',
            'ussd_priority',
            'parent_match_id',
            ['label' => 'Competition', 'attribute' => 'competitionName'],
            // 'competition_id',
            // 'status',
            // 'bet_closure',
            // 'created_by',
            // 'created',
            // 'modified',
//             'match_result',
            // 'bet_result',
            // 'completed',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
