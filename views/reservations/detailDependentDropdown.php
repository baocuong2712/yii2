<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Customer;
use app\models\Reservation;

$urlReservationsByCustomer = Url::to(['reservations/ajax-drop-down-list-by-customer-id']);
$this->registerJs(
    <<< EOT_JS
    $('#reservation-customer_id').change(function(ev) {
        $('#detail').hide();
        var customerId = $(this).val();
        $.get(
            '{$urlReservationsByCustomer}', { 'customer_id': customerId },
            function(data) {
                $('#reservation-id').html(data);
            }
        );
        ev.preventDefault();
    });
    
    $('#reservation-id').change(function(ev) {
        $('#login-form').submit();
        ev.preventDefault();
    });
EOT_JS
);
?>

<div class="customer-form">
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableAjaxValidation' => false,
'enableClientValidation' => false, 'options' => ['data-pjax' => '']]); ?>

    <?php $customers = Customer::find()->all(); ?>
    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map( $customers,
'id', 'nameAndSurname')) ?>

    <?php $reservations = Reservation::findAll(['customer_id' => $model->customer_id]); ?>
    <?= $form->field($model, 'id')->label('Reservation ID')->dropDownList(ArrayHelper::map($reservations,
'id', function($temp, $defaultValue) {
        $content = sprintf('reservation #%s at %s', $temp->id, date('Y-m-d H:i:s', strtotime($temp->reservation_date)));
        return $content;
    }));
    ?>
     <?= Html::submitButton('Submit', ['name' => 'login-button']) ?>

    <div id="detail">
    <?php if($showDetail) { ?>
        <hr />
        <h2>Reservation Detail:</h2>
        <table>
            <tr>
                <td>Price per day: </td>
                <td><?php echo $model->price_per_day ?></td>
            </tr>
    </table>
    <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>