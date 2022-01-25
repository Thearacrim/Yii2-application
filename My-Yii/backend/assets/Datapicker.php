<?php

namespace backend\assets;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class Datapicker extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css',
    ];
    public $js = [
        'https://code.jquery.com/jquery-1.10.2.js',
        'https://code.jquery.com/ui/1.10.4/jquery-ui.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
