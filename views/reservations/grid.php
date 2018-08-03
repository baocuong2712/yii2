<?php
use yii\grid\GridView;
?>

<h2>Reservations</h2>

<?php
$sumOfPricesPerDay = 0;
$averagePricePerDay = 0;

if (count($dataProvider->getModels()) > 0) {
    foreach ($dataProvider->getModels() as $model) {
        $sumOfPricesPerDay += $model->price_per_day;
        $averagePricePerDay = $sumOfPricesPerDay / sizeof($dataProvider->getModels());
    }
}
?>

<?php
$roomsFilterData = \yii\helpers\ArrayHelper::map(\app\models\Room::find()->all(), 'id', function ($model, $defaultValue) {
    return sprintf('Floor: %d - Room number: %d', $model->floor, $model->room_number);
});
?>

<?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel, // to apply filters to GridView
        'showFooter' => true,
        'columns' => [
            'id',
//            [
//                'header' => 'Room',
//                'filter' => \yii\helpers\Html::activeDropDownList($searchModel, 'room_id',
//                    $roomsFilterData, ['prompt' => '--- all']),
//                'content' => function($model) {
//                    return $model->room->floor;
//                }
//            ],
            'room_id',
//            'customer_id',
//            'customer.surname',
            [
                'header' => 'Customer',
//                'attribute' => 'customer.surname',
                'attribute' => 'customer.nameAndSurname'
            ],
//            'price_per_day',
            [
                'attribute' => 'price_per_day',
                'footer' => Yii::$app->formatter->asCurrency($sumOfPricesPerDay, 'USD')
            ],
            'date_from',
            'date_to',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'header' => 'Actions',
            ],
        ],
    ])
?>
