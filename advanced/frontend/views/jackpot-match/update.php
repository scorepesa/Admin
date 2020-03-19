<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JackpotMatch */

$this->title = 'Update Jackpot Match: ' . $model->jackpot_match_id;
$this->params['breadcrumbs'][] = ['label' => 'Jackpot Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jackpot_match_id, 'url' => ['view', 'id' => $model->jackpot_match_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jackpot-match-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_update_form', [
        'model' => $model,
    ])
    ?>

</div>
