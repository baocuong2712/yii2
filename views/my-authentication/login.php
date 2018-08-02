<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/2/2018
 * Time: 11:04 AM
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php
if ($error != null) {
    echo \yii\bootstrap\Alert::widget(['option' => ['class' => 'alert-danger'], 'body' => $error]);
}
?>

<?php if(Yii::$app->user->isGuest) { ?>

    <?php ActiveForm::begin() ?>
        <div class="form-group">
        <?php echo Html::label('Username', 'Username') ?>
        <?php echo Html::textInput('username', '', ['class' => 'form-control']) ?>
        </div>

        <div class="form-group">
        <?= Html::label('Password', 'password') ?>
        <?= Html::passwordInput('password', '', ['class' => 'form-control']) ?>
        </div>

        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>

<?php } else { ?>
    <h2>You are authenticated!</h2>
    <br>
    <?= Html::a('Log out', ['my-authentication/logout'], ['class' => 'btn btn-warning']) ?>
<?php } ?>
