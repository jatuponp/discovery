<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\web\themes\convas\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot/themes/convas/';
    public $baseUrl = '@web/themes/convas/';
    public $css = [
        'css/style.css',
        'css/dark.css',
        'css/font-icons.css',
        'css/animate.css',
        'css/magnific-popup.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/plugins.js',
        'js/functions.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
