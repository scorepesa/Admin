<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OddKeyAliasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Odd Key Aliases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odd-key-alias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Odd Key Alias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'odd_key_alias_id',
            'sub_type_id',
            'typeName',
            'odd_key',
            'odd_key_alias',
            'special_bet_value',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
