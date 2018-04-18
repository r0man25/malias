<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class JqueryUiAsset extends AssetBundle
{
    public $sourcePath = "@bower/jquery-ui";
    public $css = [
        'themes/black-tie/jquery-ui.css',
    ];
    public $js = [
        'jquery-ui.min.js',
    ];
    public $depends = [

    ];
}
