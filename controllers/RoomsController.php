<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 7/31/2018
 * Time: 2:24 PM
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

use app\models\Room;
use app\models\Customer;
use app\models\Reservation;

class RoomsController extends Controller {
    public function actionCreate() {
        $model = new Room();
//        $modelCanSave = false;
//
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//
//            // Chua hieu lam ve viec tai sao lai co doan nay, khong phai ham load() o tren da fill du lieu tu form vao field cua Model?
//            $model->fileImage = UploadedFile::getInstance($model, 'fileImage');
//
//            if ($model->fileImage) {
//                $model->fileImage->saveAs(Yii::getAlias('@uploadedfilesdir/' . $model->fileImage->baseName . '.' . $model->fileImage->extension));
//            }
//
//            $modelCanSave = true;
//        }
//        return $this->render('create', ['model' => $model, 'modelSaved' => $modelCanSave]);

        // Check if $_POST['Room'] contains data, cách 1.
//        if (isset($_POST['Room'])) {
//            $model->attributes = $_POST['Room'];
//
//            // Save model
//            if ($model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        }
        // Cách 2.
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['detail', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id) {
        // 1. Create a new Room instance;
        $model = Room::findOne($id);

        // 2. Check if $_POST['Room'] contains data and save model;
        if( ($model!=null) && $model->load(Yii::$app->request->post()) && ($model->save()))
        {
            return $this->redirect(['detail', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDetail($id) {
        $model = Room::findOne($id);

        return $this->render('detail', ['model' => $model]);
    }

    public function actionIndex() {
        $sql = 'SELECT * FROM room';

        $db = Yii::$app->db;
        $rooms = $db->createCommand($sql)->queryAll();

        // same of
        // $rooms = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->render('index', ['rooms' => $rooms]);
    }

    public function actionIndexFiltered() {
        $query = Room::find();

        $searchFilter = [
            'floor' => ['operator' => '', 'value' => ''],
            'room_number' => ['operator' => '', 'value' => ''],
            'price_per_day' => ['operator' => '', 'value' => '']
        ];

        if (isset($_POST['SearchFilter'])) {
            $fieldsList = ['floor', 'room_number', 'price_per_day'];

            foreach ($fieldsList as $field) {
                $fieldOperator = $_POST['SearchFilter'][$field]['operator']; // =
                $fieldValue = $_POST['SearchFilter'][$field]['value']; // 2

                $searchFilter[$field] = ['operator' => $fieldOperator, 'value' => $fieldValue];

                if ($fieldValue != '') {
                    $query->andWhere([$fieldOperator, $field, $fieldValue]);
                }
            }
        }

        $rooms = $query->all();

        return $this->render('indexFiltered', ['rooms' => $rooms, 'searchFilter' => $searchFilter]);
    }

    public function actionLastReservationByRoomId($room_id) {
        $room = Room::findOne($room_id);
        $lastReservation = $room->lastReservation;

        return $this->render('lastReservationByRoomId', ['room' => $room, 'lastReservation' => $lastReservation]);
    }

    public function actionIndexWithRelationships() {
        // 1. Check what parameter of detail has been passed
        $room_id = Yii::$app->request->get('room_id', null);
        $reservation_id = Yii::$app->request->get('reservation_id', null);
        $customer_id = Yii::$app->request->get('customer_id', null);

        // 2. Fill the three models: roomSelected, reservationSelected and customerSelected
        // And fill three arrays of models: rooms, reservations and customers;
        $roomSelected = null;
        $reservationSelected = null;
        $customerSelected = null;

        if ($room_id != null) {
            $roomSelected = Room::findOne($room_id);

            $rooms = array($roomSelected);
            $reservations = $roomSelected->reservations;
            $customers = $roomSelected->customers;
        }
        else if($reservation_id != null)
        {
            $reservationSelected = Reservation::findOne($reservation_id);
            $rooms = array($reservationSelected->room);
            $reservations = array($reservationSelected);
            $customers = array($reservationSelected->customer);
        }
        else if($customer_id != null)
        {
            $customerSelected = Customer::findOne($customer_id);
            $rooms = $customerSelected->rooms;
            $reservations = $customerSelected->reservations;
            $customers = array($customerSelected);
        }
        else
        {
            $rooms = Room::find()->all();
            $reservations = Reservation::find()->all();
            $customers = Customer::find()->all();
        }

        return $this->render('indexWithRelationships', [
            'roomSelected' => $roomSelected,
            'reservationSelected' => $reservationSelected,
            'customerSelected' => $customerSelected,
            'rooms' => $rooms, 'reservations' => $reservations, 'customers' => $customers
        ]);
    }
}





























