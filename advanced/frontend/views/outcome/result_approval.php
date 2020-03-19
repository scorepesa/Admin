<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\DropDownActionColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutcomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Result Approval';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="outcome-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>
    <p>
        <a  href="<?php echo Url::to(['outcome/resulting']) ?>" class="btn btn-warning" role="button">Back to Resulting</a>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'home_team',
            'away_team',
            'parent_match_id',
            'game_id',
            'ht_score',
            'ft_score',
            'created_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{my_button}',
                'buttons' => [
                    'my_button' => function ($url, $model, $key) {
                        return $this->render('_result_approval_form', ['model' => $model]);
                    },
                        ]
            ]
            ]
            ]);
            ?>
            <?php Pjax::end(); ?></div>
