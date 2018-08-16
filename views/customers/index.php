<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'surname',
            'phone_number',

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
