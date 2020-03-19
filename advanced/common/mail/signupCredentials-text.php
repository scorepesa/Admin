<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$credLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>
Hello <?= $user->username ?>,

Username: <?= $user->username ?>
Password: <?= $rawpassword ?>

Follow the link below to login to your scorepesa portal account:

<?= $credLink ?>
