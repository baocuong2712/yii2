<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 7/31/2018
 * Time: 9:16 AM
 */

    if($year != null) { ?>
        <b>List for year '<?= $year ?>'</b>
<?php } ?>
<?php
    if($category != null) { ?>
        <b>List for category '<?= $category ?>'<b>
<?php } ?>

<br><br>
<table>
    <tr>
        <th>Date</th>
        <th>Category</th>
        <th>Title</th>
    </tr>

<?php foreach ($filteredData as $fd) { ?>
    <tr>
        <td><?= $fd["date"] ?></td>
        <td><?= $fd['category'] ?></td>
        <td><?= $fd['title'] ?></td>
    </tr>
<?php } ?>
</table>
