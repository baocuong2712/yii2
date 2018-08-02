<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-lg-12">
        <table class="table">
            <tr>
                <td>User</td>
                <?php foreach($rolesAvailable as $r) { ?>
<!--                Create a reservation, Update reservation, Delete reservation, Create a room, Update room, Delete room, Create a customer, Update customer, Delete customer, operator, admin-->
                    <td><?php echo $r->description ?></td>
                <?php } ?>
            </tr>
            <?php foreach($users as $u) { ?>
            <tr>
                <td><?php echo $u->username ?></td>
                <?php foreach($rolesAvailable as $r) { ?>
                    <td align="center">
<!--                    $r->name in $rolesNamesByUser[$u->id].-->
                        <?php if(in_array($r->name, $rolesNamesByUser[$u->id])) { ?>
                            <?php echo Html::a('Yes', ['remove-role', 'userId' => $u->id,
                                'roleName' => $r->name]); ?>
                        <?php } else { ?>
                            <?php echo Html::a('No', ['add-role', 'userId' => $u->id, 'roleName'
                            => $r->name]); ?>
                        <?php } ?>
                    </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
