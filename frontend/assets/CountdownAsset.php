<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CountdownAsset extends AssetBundle
{
    public $sourcePath = "@bower/jquery.countdown";
    public $css = [
    ];
    public $js = [
        'dist/jquery.countdown.min.js'
    ];
    public $depends = [

    ];
}
