<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class NivoSliderAsset extends AssetBundle
{
    public $sourcePath = "@bower/nivo-slider";
    public $css = [
        'nivo-slider.css',
    ];
    public $js = [
        'jquery.nivo.slider.js',
    ];
    public $depends = [

    ];
}
