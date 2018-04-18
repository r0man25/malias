<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AnimateCssAsset extends AssetBundle
{
    public $sourcePath = "@bower/animate-css";
    public $css = [
        'animate.css',
    ];
    public $js = [
    ];
    public $depends = [

    ];
}
