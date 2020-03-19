<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OddTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Odd Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odd-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
     <!--
    <p>
        <?= Html::a('Create Odd Type', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-success" href="<?php echo Url::to(['odd-type/addcustommarket']) ?>">Bleague Custom Market</a>
    </p>
    -->
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'bet_type_id',
            'name',
            'created_by',
            'created',
            'modified',
            'sub_type_id',
            'short_name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
