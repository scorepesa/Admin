<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class CopyClipboardAsset extends AssetBundle {

    public $sourcePath = '@bower/clipboard/dist';
    public $js = [
        'clipboard.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
    ];

}
