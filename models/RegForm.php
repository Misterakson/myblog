<?php

namespace app\models;

use yii\base\Model;
//use Yii;
//use yii\web\User;
//use app\models\Users;


class RegForm extends Model
{

    public $name;
    public $email;
    public $password;
    public $status;

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['name', 'email', 'password'], 'filter', 'filter' => 'trim'],
            ['name', 'string', 'min' => 2, 'max' => 200],
            ['name', 'unique', 'targetClass' => Users::className(), 'message' => 'Это имя уже занято'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => Users::className(), 'message' => 'Эта почта уже используется'],
            ['status', 'default',
                'value' => Users::STATUS_ACTIVE, 'on' => 'default'
            ],
            ['password', 'string', 'min' => 6, 'max' => 200],
            ['status', 'in', 'range'=>[
                Users::STATUS_NOT_ACTIVE,
                Users::STATUS_ACTIVE
            ]],


        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя пользователя',
            'password' => 'Пароль',
            'email' => 'Email'
        ];
    }


    public function reg()
    {
        //Error here
        $user = new Users();
        //Error here
        $user->name = $this->name;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}