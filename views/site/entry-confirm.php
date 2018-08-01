<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 7/30/2018
 * Time: 11:10 AM
 */
use yii\helpers\Html;
?>
<p>Bạn đã nhập với những thông tin như sau: </p>
<ul>
    <li><label for=""><?= Html::encode($model->name) ?></label></li>
    <li><label for=""><?= Html::encode($model->email)?></label></li>
</ul>
