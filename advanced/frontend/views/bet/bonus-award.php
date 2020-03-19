<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bet */
?>
<div class="bet-update">

    <h1><?= Html::encode($this->title) ?></h1>

<?=
$this->render('_award_bonus_form', [
    'model' => $model,
])
?>

</div>
