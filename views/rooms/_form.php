<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'floor')->textInput(['value' => isset($_POST['Room[floor]']) ? $_POST['Room[floor]'] : '123']) ?>

    <?= $form->field($model, 'room_number')->textInput() ?>

    <?= $form->field($model, 'has_conditioner')->textInput() ?>

    <?= $form->field($model, 'has_tv')->textInput() ?>

    <?= $form->field($model, 'has_phone')->textInput() ?>

    <?= $form->field($model, 'available_from')->textInput() ?>

    <?= $form->field($model, 'price_per_day')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
