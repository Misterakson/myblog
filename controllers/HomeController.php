<?php


namespace app\controllers;

use yii\data\Pagination;
use app\models\Posts;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\Users;
use app\models\Profile;
use Yii;

class HomeController extends BehaviorsController
{

    public function actionIndex()
    {
        $query = Posts::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $posts = $query->orderBy('title')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',[
            'posts' => $posts,
            'pagination' => $pagination
            ]);
    }

    public function actionReg()
    {
        $model = new RegForm();

        if( $model->load(Yii::$app->request->post()) && $model->validate() ):
            if($user = $model->reg()):
                if ($user->status === Users::STATUS_ACTIVE):
                    if(Yii::$app->user->login($user)):
                        return $this->goHome();
                    endif;
                endif;
            else:
                Yii::$app->session->setFlash('error','Воздникла ошибка при регистрации'); //Выводим сообщение об ошибке
                Yii::error('Ошибка при регистрации'); //Пишем ошибку в журнал
                return $this->refresh();
            endif;
        endif;
        return $this->render('reg', ['model' => $model]);
    }

    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest):
            return $this->goHome();
        endif;

        $model = new LoginForm();

        if( $model->load(Yii::$app->request->post()) && $model->login()):
            return $this->goBack();
        endif;

        return $this->render('login', ['model' => $model]);
    }

    public function actionProfile()
    {
        $model = ($model = Profile::findOne(Yii::$app->user->id)) ? $model : new Profile();

        if($model->load(Yii::$app->request->post()) && $model->validate() ):

            if($model->updateProfile($model)):
                Yii::$app->session->setFlash('success', 'Профиль успешно изменён');
            else:
                Yii::$app->session->setFlash('error', 'Ошибка при изменении профиля');
                Yii::error('Ошибка записи. Профиль не изменён');
                return $this->refresh();
            endif;
        endif;

        return $this->render('profile' , ['model' => $model]);

    }

    public function actionPost()
    {
        $post = ($post = Yii::$app->request->get('id')) ? Posts::findOne($post) : false;
        if($post):
            return $this->render('post', ['post' => $post]);
        endif;

        return $this->goHome();

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


}