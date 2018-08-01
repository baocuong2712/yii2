<br>
<br>
<table class="table">
    <tr>
        <td>Floor</td>
        <td>Room number</td>
        <td>Has conditioner</td>
        <td>Has tv</td>
        <td>Has phone</td>
        <td>Available from</td>
        <td>Available from (db format)</td>
        <td>Price per day</td>
        <td>Description</td>
    </tr>
<?php foreach ($rooms as $room){ ?>
    <tr>
        <td><?= $room['floor'] ?></td>
        <td><?= $room['room_number'] ?></td>
        <td><?= Yii::$app->formatter->asBoolean($room['has_conditioner']) ?></td>
        <td><?= Yii::$app->formatter->asBoolean($room['has_tv']) ?></td>
        <td><?= ($room['has_phone'] == 1) ? 'Yes' : 'No' ?></td>
        <td><?= Yii::$app->formatter->asDate($room['available_from']) ?></td>
        <td><?= Yii::$app->formatter->asDate($room['available_from'], 'php: Y-m-d') ?></td>
        <td><?= Yii::$app->formatter->asCurrency($room['price_per_day'], 'EUR') ?></td>
        <td><?= $room['description'] ?></td>
    </tr>
<?php } ?>
</table>