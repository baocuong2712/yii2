<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\ReservationAssetBundle;
use app\models\Room;
use app\models\Block;

/* @var $this yii\web\View */
/* @var $model app\models\Reservation */
/* @var $form yii\widgets\ActiveForm */

ReservationAssetBundle::register($this);
?>

<div class="reservation-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'customer_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Customer::find()->all(), 'id', 'name'),
        [
            'prompt' => 'Select customer please!'
        ]
    ) ?>

    <?= $form->field($model, 'room_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(Room::find()->all(), 'id', 'room_number'),
        ['prompt' => 'Select room please!']
    ) ?>

    <?= $form->field($model, 'block')->dropDownList(
        \yii\helpers\ArrayHelper::map(Block::find()->all(), 'id', 'block_name')
    ) ?>

    <?= $form->field($model, 'hotel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_per_day')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_from')->widget(\yii\jui\DatePicker::class, [
        'language' => 'en',
        'dateFormat' => 'y-MM-d',
        'options' => ['class' => 'form-control']
    ]) ?>

    <?= $form->field($model, 'date_to')->widget(\yii\jui\DatePicker::class, [
        'language' => 'en',
        'dateFormat' => 'y-MM-d',
        'options' => ['class' => 'form-control', 'disabled' => 'disabled']
    ]) ?>

    <?= $form->field($model, 'reservation_date')->widget(\yii\jui\DatePicker::class, [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
