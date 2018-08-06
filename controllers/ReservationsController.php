<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/3/2018
 * Time: 11:37 AM
 */

namespace app\controllers;


use app\models\ReservationSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\Reservation;

class ReservationsController extends Controller
{
    public function actionGrid() {
        $query = \app\models\Reservation::find();
        $searchModel = new \app\models\ReservationSearch();
        if(isset($_GET['ReservationSearch']))
        {
            $searchModel->load( \Yii::$app->request->get() );
            $query->joinWith(['customer']);
            $query->andFilterWhere(
                ['LIKE', 'customer.surname', $searchModel->getAttribute('customer.surname')]
            );
            $query->andFilterWhere([
                'id' => $searchModel->id,
                'customer_id' => $searchModel->customer_id,
                'room_id' => $searchModel->room_id,
                'price_per_day' => $searchModel->price_per_day,
            ]);
        }

        $query->where(["=", 'customer_id', $_GET['Reservation']['customer_id']]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('grid', [ 'dataProvider' => $dataProvider, 'searchModel' =>
    $searchModel ]);
    }

    public function actionMultipleGrid() {
        /**
         * Reservations
         */
        $reservationsQuery = Reservation::find();
        $reservationsSearchModel = new ReservationSearch();

        if (isset($_GET['ReservationSearch'])) {
            $reservationsSearchModel->load(\Yii::$app->request->get());

            $reservationsQuery->joinWith(['customer']);
            $reservationsQuery->andFilterWhere(['customer.surname' => $reservationsSearchModel->getAttribute('customer.surname')]);

            // Adds an additional WHERE condition [AND FILTER WHERE] to the existing one.
            $reservationsQuery->andFilterWhere([
                'id' => $reservationsSearchModel->id,
                'customer_id' => $reservationsSearchModel->customer_id,
                'room_id' => $reservationsSearchModel->room_id,
                'price_per_day' => $reservationsSearchModel->price_per_day,
            ]);
        }
        $reservationsDataProvider = new ActiveDataProvider([
            'query' => $reservationsQuery,
            'sort' => [
                'sortParam' => 'reservations-sort-param',
            ],
            'pagination' => [
                'pageSize' => 10,
                'pageParam' => 'reservation-page-param'
            ]
        ]);

        /**
         * Rooms
         */
        $roomsQuery = \app\models\Room::find();
        $roomsSearchModel = new \app\models\Room();
        if(isset($_GET['Room']))
        {
            $roomsSearchModel->load( \Yii::$app->request->get() );
            $roomsQuery->andFilterWhere([
                'id' => $roomsSearchModel->id,
                'floor' => $roomsSearchModel->floor,
                'room_number' => $roomsSearchModel->room_number,
                'has_conditioner' => $roomsSearchModel->has_conditioner,
                'has_phone' => $roomsSearchModel->has_conditioner,
                'has_tv' => $roomsSearchModel->has_conditioner,
                'available_from' => $roomsSearchModel->has_conditioner,
            ]);
        }
        $roomsDataProvider = new \yii\data\ActiveDataProvider([
            'query' => $roomsQuery,
            'sort' => [
                'sortParam' => 'rooms-sort-param',
            ],
            'pagination' => [
                'pageSize' => 10,
                'pageParam' => 'rooms-page-param'
            ],
        ]);
        return $this->render('multipleGrid', [
            'reservationsDataProvider' => $reservationsDataProvider, 'reservationsSearchModel' => $reservationsSearchModel,
            'roomsDataProvider' => $roomsDataProvider, 'roomsSearchModel' => $roomsSearchModel
        ]);
    }

    public function actionDetailDependentDropdown() {
        $showDetail = false;
        $model = new Reservation();

        if (isset($_POST['Reservation'])) {
            $model->load(\Yii::$app->request->post());

            if (isset($_POST['Reservation']['id']) && $_POST['Reservation']['id'] != null) {
                $model = Reservation::findOne($_POST['Reservation']['id']);
                $showDetail = true;
            }
        }

        return $this->render('detailDependentDropdown', ['model' => $model, 'showDetail' => $showDetail]);
    }

    public function actionAjaxDropDownListByCustomerId($customer_id) {
        $output = '';
        $items = Reservation::findAll(['customer_id' => $customer_id]);

        foreach ($items as $item) {
            $content = sprintf('Reservation #%s at %s', $item->id, date('Y-m-d H:i:s', strtotime($item->reservation_date)));
            $output .= \yii\helpers\Html::tag('option', $content, ['value' => $item->id]);
        }

        return $output;
    }
}

























