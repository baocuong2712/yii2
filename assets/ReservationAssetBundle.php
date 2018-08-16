<?php

namespace app\assets;

use yii\web\YiiAsset;

class ReservationAssetBundle extends YiiAsset {
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [

    ];
    public $js = [
        'js/reservation.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}