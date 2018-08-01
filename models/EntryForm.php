<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 7/30/2018
 * Time: 10:28 AM
 */
namespace app\models;
use yii\base\Model;

class EntryForm extends Model {
    public $name;
    public $email;

    public function rules() {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email']
        ];
    }
}