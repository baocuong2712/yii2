<?php
/**
 * Created by PhpStorm.
 * User: New York
 * Date: 13/8/2018
 * Time: 20:08 PM
 */

namespace app\models;

use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $password;
    public $newPassword;
    public $reenterPassword;

    private $_user = false;

    public function rules() {
        return [
            ['password', 'required'],
            ['newPassword', 'required'],
            ['reenterPassword', 'required'],
            ['reenterPassword',
                'compare',
                'compareAttribute' => 'newPassword',
                'message' => "Passwords don't match"
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            //'user_profile_id' => 'User Profile ID',
            //'user_ref_id' => 'User Ref ID',
            'password' => 'Password',
            'newPassword' => 'Change Password',
            'reenterPassword' => 'Re-enter Password',
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @return User|mixed|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}