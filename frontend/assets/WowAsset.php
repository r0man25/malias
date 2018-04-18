<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class WowAsset extends AssetBundle
{
    public $sourcePath = "@bower/wow";
    public $css = [
    ];
    public $js = [
        'dist/wow.min.js'
    ];
    public $depends = [

    ];
}
