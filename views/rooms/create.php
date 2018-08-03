<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>

<h2>Create a new room</h2>

<div class="row">
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="col-lg-6">
        <?= $this->render('_form', ['model' => $model]); ?>
    </div>
</div>
