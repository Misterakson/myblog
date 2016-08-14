<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Posts;


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
                        'actions' => ['reg', 'login','index','post'], // для экшнов логин и регистрация
                        'verbs' => ['GET', 'POST'], // Методами пост и гет
                        'roles' => ['?'] // доступ пользователям, которые являются гостями
                    ],
                    [
                        'allow' => false,
                        'controllers' => ['post'],
                        'verbs' => ['GET','POST'],
                        'roles' => ['?']
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
//                    [
//                        'allow' => true,
//                        'controllers' => ['post'],
//                        'actions' => ['create', 'update', 'delete', 'view'],
//                        'verbs' => ['GET', 'POST'],
//                        'roles' => ['@']
//                    ]
                ]
            ],

        ];
    }

}