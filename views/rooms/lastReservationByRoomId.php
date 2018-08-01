<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/1/2018
 * Time: 3:50 PM
 */
?>
<table class="table">
    <tr>
        <td>Room Id</td>
        <td><?= $lastReservation['room_id'] ?></td>
    </tr>
    <tr>
        <td>Customer Id</td>
        <td><?= $lastReservation['customer_id'] ?></td>
    </tr>
    <tr>
        <td>Price per day</td>
        <td><?= Yii::$app->formatter->asCurrency($lastReservation['price_per_day'], 'EUR') ?></td>
    </tr>
    <tr>
        <td>Date from</td>
        <td><?= Yii::$app->formatter->asDate($lastReservation['date_from'], 'php:d-m-Y') ?></td>
    </tr>
    <tr>
        <td>Date to</td>
        <td><?= Yii::$app->formatter->asDate($lastReservation['date_to'], 'php:Y-m-d') ?></td>
    </tr>
    <tr>
        <td>Reservation date</td>
        <td><?= Yii::$app->formatter->asDate($lastReservation['reservation_date'], 'php:y-m-d H:i:s') ?></td>
    </tr>
</table>
