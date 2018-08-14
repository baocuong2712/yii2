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

            'id',
            'username',
            'email:email',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function($url) {
                        return Html::a("<span class='btn btn-info'>View</span>", $url, [
                            'title' => Yii::t('yii', 'View')
                        ]);
                    },
                    'update' => function($url) {
                        return Html::a('<span class="btn btn-success">Reset password</span>', $url, [
                            'title' => Yii::t('yii', 'Reset password')
                        ]);
                    },
                    'delete' => function($url) {
                        return Html::a('<span class="btn btn-success">Delete acount</span>', $url, [
                            'title' => Yii::t('yii', 'Delete acount')
                        ]);
                    }
                ]
            ]
        ],
    ]); ?>
</div>
