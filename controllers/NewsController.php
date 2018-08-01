<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 7/31/2018
 * Time: 8:57 AM
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;

class NewsController extends Controller
{
    public function data()
    {
        return [
            ["id" => 1, "date" => "2015-04-19", "category" => "business", "title" => "Test news
of 2015-04-19"],
            ["id" => 2, "date" => "2015-05-20", "category" => "shopping", "title" => "Test news
of 2015-05-20"],
            ["id" => 3, "date" => "2015-06-21", "category" => "business", "title" => "Test news
of 2015-06-21"],
            ["id" => 4, "date" => "2016-04-19", "category" => "shopping", "title" => "Test news
of 2016-04-19"],
            ["id" => 5, "date" => "2017-05-19", "category" => "business", "title" => "Test news
of 2017-05-19"],
            ["id" => 6, "date" => "2018-06-19", "category" => "shopping", "title" => "Test news
of 2018-06-19"]
        ];
    }

    public function actionItemList()
    {
        // if missing, value will be null
        $year = Yii::$app->request->get('year');
        $category = Yii::$app->request->get('category');

        $data = $this->data();
        $filteredData = [];

        foreach ($data as $d) {
            if (($year != null) && (date('Y', strtotime($d['date'])) == $year)) {
                $filteredData[] = $d;
            }
            if (($category != null) && ($d['category'] == $category)) {
                $filteredData[] = $d;
            }
            return $this->render('itemList', ['year' => $year, 'category' => $category, 'filteredData' => $filteredData]);
        }
    }

    function actionIndex() {
        return $this->render('index');
    }

    function actionInternationalIndex() {
        // if missing, value will be 'en'
        $lang = Yii::$app->request->get('lang', 'en');

        Yii::$app->language = $lang;

        return $this->render('InternationalIndex');
    }
}