<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>

<?php if ($modelSaved) { ?>
    <div class="alert alert-success">
        Model ready to be saved!
        <br>
        <br>
        These are values: <br />
        Floor: <?php echo $model->floor ?><br />
        Room Number: <?= $model->room_number ?><br />
        Has conditioner: <?= Yii::$app->formatter->asBoolean($model->has_conditioner); ?><br />
        Has TV: <?= Yii::$app->formatter->asBoolean($model->has_tv); ?><br />
        Has phone: <?= Yii::$app->formatter->asBoolean($model->has_phone); ?><br />
        Available from (mm/dd/yyyy): <?= Yii::$app->formatter->asDate($model->available_from, 'php:m/d/Y'); ?><br />
        Price per day: <?= Yii::$app->formatter->asCurrency($model->price_per_day, 'EUR'); ?><br />
        Image:
        <?php if (isset($model->fileImage)) { ?>
            <img src="<?= Url::to(['image/get-image','imageName' => $model->fileImage->name]); ?>" alt="Something wrong" />
            <img src="<?= '/basic/web/images/uploadedfiles/'.$model->fileImage->name; ?>" alt="Something wrong" />
        <?php } ?>
    </div>
<?php } ?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-lg-12">
        <h1>Room form</h1>
        <?= $form->field($model, 'floor')->textInput() ?>
        <?= $form->field($model, 'room_number')->textInput() ?>
        <?= $form->field($model, 'has_conditioner')->checkbox() ?>
        <?= $form->field($model, 'has_tv')->checkbox() ?>
        <?= $form->field($model, 'has_phone')->checkbox() ?>
        <?= $form->field($model, 'available_from')->textInput() ?>
        <?= $form->field($model, 'price_per_day')->textInput() ?>
        <?= $form->field($model, 'description')->textInput() ?>

        <?= $form->field($model, 'fileImage')->fileInput() ?>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
