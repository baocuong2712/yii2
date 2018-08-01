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
use app\models\Room;
use yii\web\UploadedFile;

class RoomsController extends Controller {
    public function actionCreate() {
        $model = new Room();
        $modelCanSave = false;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            // Chua hieu lam ve viec tai sao lai co doan nay, khong phai ham load() o tren da fill du lieu tu form vao field cua Model?
            $model->fileImage = UploadedFile::getInstance($model, 'fileImage');

            if ($model->fileImage) {
                $model->fileImage->saveAs(Yii::getAlias('@uploadedfilesdir/' . $model->fileImage->baseName . '.' . $model->fileImage->extension));
            }

            $modelCanSave = true;
        }
        return $this->render('create', ['model' => $model, 'modelSaved' => $modelCanSave]);
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
}





























