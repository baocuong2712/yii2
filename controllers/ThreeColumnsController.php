<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/6/2018
 * Time: 8:54 AM
 */

namespace app\controllers;


use yii\web\Controller;

class ThreeColumnsController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
    }
}