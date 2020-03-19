<?php

use yii\helpers\Html;
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Url;
use app\models\JackpotEvent;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JpbonusAwardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jpbonus Awards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jpbonus-award-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Jpbonus Award', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-info" href="<?php echo Url::to(['jpbonus-award/awardjackpotbonus']) ?>">Award Jackpot Bonus</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'jackpot_event_id',
            'total_games_correct',
            'jackpot_bonus',
            'scorepesa_points_bonus',
            'created_by',
            'approved_by',
            'status',
            'created',
            'modified',
            [
                'format' => 'raw',
                'width'=>'150px',
                'value' => function($model, $key, $index, $column) {
                        if ($model->status == 0){
                            $class = 'btn btn-success';
                            $text = 'Approve';

                        }else {
                            $class = 'btn btn-default disabled';
                            $text = 'Aprroved';
                        }

                        return Html::a(
                            'Approve',
                            Url::to(['jpbonus-award/approvebonusaward', 'id' => $model->id, 'approvedBy' => Yii::$app->user->identity->username]), 
                            [
                                'id'=>'grid-custom-button',
                                'data-pjax'=>true,
                                'action'=>Url::to(['jpbonus-award/approvebonusaward', 'id' => $model->id]),
                                'class'=>[$class],
                                'label'=>[$text],
                            ]
                        );
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
