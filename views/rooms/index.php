<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Room', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Showing {begin} - {end} of {totalCount} items",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'floor',
            'room_number',
            'has_conditioner',
            'has_tv',
            //'has_phone',
            //'available_from',
            //'price_per_day',
            //'description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'contentOptions' => ['style' => 'width:220px;'],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span style="margin-right: 10px" class="btn btn-info btn-xs">View</span>', $url, [
                            'title' => Yii::t('yii', 'View'),
                        ]);
                    },
                    'update' => function($url, $model, $key) {
                        return Html::a('<span style="margin-right: 10px" class="btn btn-success btn-xs">Update</span>', $url, [
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
