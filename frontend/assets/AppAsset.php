<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Raleway:400,600',
        'https://fonts.googleapis.com/css?family=Roboto:400,700',
        'css/style.css',
        'css/responsive.css',
//        'css/site.css',
    ];
    public $js = [
        'js/plugins.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'frontend\assets\FontAwesomeAsset',
        'frontend\assets\OwlCarouselAsset',
        'frontend\assets\NivoSliderAsset',
        'frontend\assets\MeanMenuAsset',
        'frontend\assets\JqueryUiAsset',
        'frontend\assets\AnimateCssAsset',
        'frontend\assets\BoilerplateAsset',
        'frontend\assets\WowAsset',
        'frontend\assets\ScrollUpAsset',
        'frontend\assets\CountdownAsset',
    ];
}
