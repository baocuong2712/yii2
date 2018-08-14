<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResetPasswordForm */

$this->title = 'Update User: ' . Yii::$app->user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->user->id, 'url' => ['view', 'id' => Yii::$app->user->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
