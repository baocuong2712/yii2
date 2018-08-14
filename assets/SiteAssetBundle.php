<?php
/**
 * Created by PhpStorm.
 * User: New York
 * Date: 11/8/2018
 * Time: 8:33 AM
 */

namespace app\assets;

use yii\web\AssetBundle;

class SiteAssetBundle extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = ['css/site.css'];
    public $js = ['js/site.js'];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}