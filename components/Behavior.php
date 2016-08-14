<?php

namespace app\components;

use yii\base\Behavior;
use Yii;
use app\models\Posts;


class UserDeny extends Behavior
{
    public function deny()
    {
        $user = new Posts();
        if(Yii::$app->user->id !== $user->user_id)
        {
            return false;
        }
    }
}