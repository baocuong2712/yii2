<?php
/**
 * Created by PhpStorm.
 * User: New York
 * Date: 10/8/2018
 * Time: 0:06 AM
 */
namespace app\components;

class CheckIfChangeLanguage extends \yii\base\Behavior
{
    public function events()
    {
        return [
            \yii\web\Application::EVENT_BEFORE_REQUEST => 'changeLanguage'
        ];
    }

    public function changeLanguage() {
        if (\Yii::$app->getRequest()->getCookies()->has('lang')) {
            \Yii::$app->language = \Yii::$app->getRequest()->getCookies()->getValue('lang');
        }
    }
}