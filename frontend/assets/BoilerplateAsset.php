<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class BoilerplateAsset extends AssetBundle
{
    public $sourcePath = "@bower/html5-boilerplate";
    public $css = [
        'dist/css/main.css',
    ];
    public $js = [
    ];
    public $depends = [

    ];
}
