<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResetPasswordForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->label('Password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'newPassword')->label('New Password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reenterPassword')->label('Confirm New Password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Reset Password', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
