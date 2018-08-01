<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 7/31/2018
 * Time: 1:05 PM
 */
use yii\helpers\Url;
use yii\helpers\Html;
?>

<b>Filter data by year:</b>
<br>
<ul>
    <?php
//      $currentYear = date('Y');
        $currentYear = 2020;
    ?>
    <?php for($year = $currentYear; $year > ($currentYear - 5); $year--) { ?>
        <li><?= Html::a('List items by year ' . $year, Url::to(['news/item-list', 'year' => $year])) ?></li>
    <?php } ?>
</ul>
<br>
<b>Filter data by category: </b>
<br>
<ul>
    <?php $categories = ['business', 'shopping']; ?>
    <?php foreach($categories as $category) { ?>
    <li>
        <?= Html::a('List items by category ' . $category, Url::to(['news/item-list', 'category' => $category])) ?>
    </li>
    <?php } ?>
</ul>
