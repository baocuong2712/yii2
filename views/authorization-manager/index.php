<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-lg-12">
        <table class="table">
            <tr>
                <td>User</td>
                <?php foreach($rolesAvailable as $roleAvailable) { ?>
<!--                Create a reservation, Update reservation, Delete reservation, Create a room, Update room, Delete room, Create a customer, Update customer, Delete customer, operator, admin-->
                    <td><?php echo $roleAvailable->name ?></td>
                <?php } ?>
            </tr>
            <?php foreach($users as $user) { ?>
            <tr>
                <td><?php echo $user->username ?></td>
                <?php foreach($rolesAvailable as $roleAvailable) { ?>
                    <td align="center">
                        <!-- $r->name in $rolesNamesByUser[$u->id], 2 cai deu tra ve admin hoac operator. -->
                        <?php if(in_array($roleAvailable->name, $rolesNamesByUser[$user->id])) { ?>
                            <?php echo Html::a('Yes', ['remove-role', 'userId' => $user->id, 'roleName' => $roleAvailable->name]); ?>
                        <?php } else { ?>
                            <?php echo Html::a('No', ['add-role', 'userId' => $user->id, 'roleName' => $roleAvailable->name]); ?>
                        <?php } ?>
                    </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
