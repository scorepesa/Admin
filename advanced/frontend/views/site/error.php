<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <div class="alert alert-warning" role="alert">
    <p>
        The above error occurred while the Web server was processing your request.
    </p>

    <?php if($this->title == "Forbidden (#403)") { ?>
    <div class="alert alert-info" role="alert">
    <p>
        Please access the allowed menus on the navigation bar at the top. Thank you.
    </p>
    </div>
    <?php } ?>

</div>
</div>
