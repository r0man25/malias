<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class MeanMenuAsset extends AssetBundle
{
    public $sourcePath = "@bower/jquery.meanmenu";
    public $css = [
        'meanmenu.css',
    ];
    public $js = [
        'jquery.meanmenu.js',
    ];
    public $depends = [
    ];
}
