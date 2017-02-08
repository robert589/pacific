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
        'css/ionicons.min.css',
        'css/font-awesome.min.css',
        'css/datepicker.css',
        'css/ie10-viewport-bug-workaround.css', 
        'css/bootstrap.min.css',
        'css/easy-responsive-tabs.css',
        'css/style2.css',
        'css/style.css',
        'css/side-bar-menu.css',
        'css/fonts/font.css',
        'css/jquery.classyscroll.css',
        'css/library/jquery-ui.min.css',
        'css/build/build.min.css'
        
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/jquery-easing.min.js',
        'js/side-bar.js',
        'js/ie-emulation-modes-warning.js',
        'js/side-menu.js',
        'js/library/jquery-ui.min.js',
        'js/library/jquery.timepicker.min.js',
        'js/library/require.js',
        'js/build.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];
}
