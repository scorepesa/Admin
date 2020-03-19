<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JackpotTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jackpot Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jackpot-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jackpot Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            'jackpot_type_id',
            'name',
            'sub_type_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
