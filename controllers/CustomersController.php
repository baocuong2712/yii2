<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/3/2018
 * Time: 11:02 AM
 */

namespace app\controllers;


use app\models\Customer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class CustomersController extends Controller
{
    public function actionGrid() {
        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('grid', ['dataProvider' => $dataProvider]);
    }
}
