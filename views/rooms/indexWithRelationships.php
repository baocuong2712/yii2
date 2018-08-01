<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/1/2018
 * Time: 4:54 PM
 */
use yii\helpers\Url;
?>

<a href="<?= Url::to(['index-with-relationships']) ?>" class="btn btn-danger">Reset</a>

<br><br>
<div class="row">
    <div class="col-md-4">
        <legend>Rooms/legend>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Floor</th>
                <th>Room number</th>
                <th>Price per day</th>
            </tr>
            <?php foreach ($rooms as $room) { ?>
            <tr>
                <td>
                    <a href="<?= Url::to(['index-with-relationships', 'room_id' => $room->id]) ?>" class="btn btn-primary btn-xs">
                        detail
                    </a>
                </td>
                <td><?= $room['floor'] ?></td>
                <td><?= $room['room_number'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>