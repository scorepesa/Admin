<?php

use yii\helpers\Html;
?>
<p>
    <?= Html::a('Back', ['index'], ['class' => 'btn btn-success']) ?>
</p>
<?php
/*
 * Easy PHP Tail 
 * by: Thomas Depole
 * v1.0
 * 
 * just fill in the varibles bellow, open in a web browser and tail away 
 */
$logFile = "/var/www/html/scorepesa-portal_stage/scorepesa-admin/advanced/frontend/runtime/logs/nohup_web.out"; // local path to log file
$interval = 1000; //how often it checks the log file for changes, min 100
$textColor = ""; //use CSS color
// Don't have to change anything bellow
if (!$textColor)
    $textColor = "white";
if ($interval < 100)
    $interval = 100;

$pattern = "/\bReceipt\b/i";
$output = preg_grep($pattern, file($logFile));
echo 'Missed Receipts';
echo '<table style="width:100%;border:1px solid black;">';
foreach ($output as $key => $value) {
    echo '<tr><td>';
    print_r($value);
    echo '</td></tr>';
}
echo '</table>';
