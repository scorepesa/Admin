<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$credLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>
<div class="sign-up">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>
       Username: <?=  Html::encode($user->username) ?> 
    </p>
    <p>
       Password: <?=  Html::encode($rawpassword) ?>
    </p>

    <p>Follow the link below to login to your account:</p>

    <p><?= Html::a(Html::encode($credLink), $credLink) ?></p>
</div>
