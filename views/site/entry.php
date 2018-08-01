<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

?>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'date_created')->widget(DatePicker::className(),['clientOptions' => ['periodfrom' => '1980-01-01'],'dateFormat' => 'yyyy-MM-dd']) ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>