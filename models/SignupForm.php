<?php
/**
 * Created by PhpStorm.
 * User: New York
 * Date: 8/7/2018
 * Time: 1:43 AM
 */

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signup() {
        //validate() is a base function.
        if (!$this->validate()) {
            return null;
        }

        $user = new \yii\web\User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}