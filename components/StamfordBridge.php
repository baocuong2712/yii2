<?php
/**
 * Created by PhpStorm.
 * User: Cuong
 * Date: 8/15/2018
 * Time: 4:14 PM
 */

namespace app\components;


use yii\helpers\Html;
use yii\jui\Widget;

class StamfordBridge extends Widget
{
    public $url;
    public $size;
    public $message;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
//        ob_start();
        if($this->message === null){
            $this->message= 'Welcome User';
        }else{
            $this->message= 'Welcome '.$this->message;
        }
    }

    public function run()
    {
        // return $this->render('Chelsea', ['message' => $this->message]);
    }
}