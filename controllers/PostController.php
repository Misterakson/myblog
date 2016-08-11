<?php

namespace app\controllers;

use app\models\Posts;
use Yii;
use yii\data\Pagination;

class PostController extends BehaviorsController
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
    public function actionCreate()
    {
        $model = new Posts();

        if($model->load(Yii::$app->request->post())){

            $model->save();
            $this->goHome();
        }




            return $this->render('create',['model' => $model]);

    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
