<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class OwlCarouselAsset extends AssetBundle
{
    public $sourcePath = "@bower/owl.carousel1";
    public $css = [
        'owl-carousel/owl.carousel.css',
        'owl-carousel/owl.theme.css',
        'owl-carousel/owl.transitions.css',
    ];
    public $js = [
        'owl-carousel/owl.carousel.min.js',
    ];
    public $depends = [
    ];
}
