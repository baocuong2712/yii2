<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            [
                'label' => 'Password',
                'attribute' => 'password_hash',
                'value' => function($model) {
                    return Yii::$app->security->decryptByPassword(utf8_decode($model->password_hash), 'London');
                },
            ],
            //'access_token',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
//                'contentOptions' => ['style' => ':;'],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span style="margin-right: 10px" class="btn btn-info btn-xs">View</span>', $url, [
                            'title' => Yii::t('yii', 'View'),
                        ]);
                    },
                    'update' => function($url, $model, $key) {
                        return Html::a('<span style="margin-right: 10px" class="btn btn-success btn-xs">Reset password</span>', 'reset-password?id=' . $model->id, [
                            'title' => Yii::t('yii', 'Update')
                        ]);
                    },

                    'delete' => function($url, $model, $key) {
                        return Html::a('<span class="btn btn-danger btn-xs">Delete</span>', $url, [
                            'title' => Yii::t('yii', 'Delete')
                        ]);
                    }
                ],
            ]
        ],
    ]); ?>
</div>
