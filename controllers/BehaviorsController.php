<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class BehaviorsController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [ //первое правило
                        'allow' => true, // - разрешить
                        'controllers' => ['home'], // - для контроллера home
                        'actions' => ['reg', 'login','index'], // для экшнов логин и регистрация
                        'verbs' => ['GET', 'POST'], // Методами пост и гет
                        'roles' => ['?'] // доступ пользователям, которые являются гостями
                    ],
                    [
                        'allow' => true, // - разрешить
                        'controllers' => ['home'], // - для контроллера home
                        'actions' => ['logout','profile','post'], // для экшнов логин и регистрация
                        'verbs' => ['GET'], // Методами пост и гет
                        'roles' => ['@'] // доступ пользователям, которые являются гостями
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['post'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index']
                    ],
                ]
            ],

        ];
    }

}