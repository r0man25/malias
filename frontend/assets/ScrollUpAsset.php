<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ScrollUpAsset extends AssetBundle
{
    public $sourcePath = "@bower/scrollup";
    public $css = [
    ];
    public $js = [
        'dist/jquery.scrollUp.min.js'
    ];
    public $depends = [

    ];
}
