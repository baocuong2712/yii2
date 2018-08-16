<?php
use app\components\ShedEndAssetBundle;
use yii\helpers\Html;

ShedEndAssetBundle::register($this);
?>

<div class="col-lg-4">
    <h2><?= Html::encode($product->name) ?></h2>

    <div class="magnify">
        <!-- This is the magnifying glass which will contain the original/large version -->
        <div class="large"></div>
        <!-- This is the small image -->
        <img class="small" src="<?= $product->image ?>" height="110" width="300"/>
    </div>
</div>

