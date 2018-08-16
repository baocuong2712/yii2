<?php
/**
 * Created by PhpStorm.
 * User: Cuong
 * Date: 8/16/2018
 * Time: 9:03 AM
 */

namespace app\components;


use yii\web\YiiAsset;

class ShedEndAssetBundle extends YiiAsset
{
    public $sourcePath = '@app/components/assets';

    public $css = ['main.css'];
    public $js = ['main.js'];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}