<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
    <h1>Все посты</h1>

    <ul>


        <?php foreach ($posts as $post) : ?>
            <li>
                <?= Html::encode("{$post->title}") ?>
            </li>
            <li>
                <?= $post->image ?>
            </li>
            <li>
                <?= Html::encode("{$post->description}") ?>
            </li>
            <li>
                <?= Html::encode("{$post->date}") ?>
<!--                <p> <a href="/yii2/web/home/post?id=--><?//=$post->id?><!--">Подробнее</a> </p>-->
            </li>
            <hr>
        <?php endforeach; ?>

    </ul>

<?= LinkPager::widget(['pagination' => $pagination]); ?>