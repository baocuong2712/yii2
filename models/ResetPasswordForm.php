<?php
/**
 * Created by PhpStorm.
 * User: Cuong
 * Date: 08/13/2018
 * Time: 4:09 PM
 */

namespace app\models;

use yii\base\Model;
use app\models\User;

class ResetPasswordForm extends Model
{
    public $password;
    public $newPassword;
    public $reenterPassword;

    public $_user;

    public function rules()
    {
        return [
            [ 'password', 'validatePassword' ],
            [ 'newPassword', 'required' ],
            [ 'reenterPassword', 'required' ],
            [ 'reenterPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => "Passwords do not match" ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Password',
            'newPassword' => 'Change Password',
            'reenterPassword' => 'Re-enter Password',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findIdentity(\Yii::$app->user->id);
        }

        return $this->_user;
    }
}