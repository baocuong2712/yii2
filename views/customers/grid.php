<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/3/2018
 * Time: 11:12 AM
 */
use yii\grid\GridView;
use yii\helpers\Html;
?>

<h2>Customer</h2>

<?=
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => [
//            'id',
//            'name',
//            'surname',
//            'phone_number',
//            [
//                'header' => 'Reservations',
//                'content' => function($model, $key, $index, $column) {
//                    $title = sprintf('Reservation (%d)', $model->reservationsCount);
//                    // Loc cac reservation co customer_id duoc click.
//                    return Html::a($title, ['reservations/grid', 'Reservation[customer_id]' => $model->id]);
//                }
//            ],
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{delete}',
//                'header' => 'Actions'
//            ]
//        ]
//    ])

    \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'phone_number',
            [
                'attribute' => 'Reservations',
                'format' => 'raw',
                'value' => function($model) {
                    $title = sprintf('Reservation (%d)', $model->reservationsCount);
                    // Loc cac reservation co customer_id duoc click.
                    return Html::a($title, ['reservations/grid', 'Reservation[customer_id]' => $model->id]);
                }
            ],
        ],
    ]);
?>
