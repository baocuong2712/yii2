<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 7/31/2018
 * Time: 5:13 PM
 */

namespace app\controllers;


use yii\web\Controller;

class ImageController extends Controller
{
    public function actionGetImage($imageName){
        $path = \Yii::getAlias('@app') . '\uploadedfiles\\' . $imageName;
        
        return \Yii::$app->response->sendFile($path);
    }
}