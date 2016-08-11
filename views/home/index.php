<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>

<h1>Все посты</h1>


<div class="row">
    <?php foreach ($posts as $post) : ?>

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail" style="background-color: #f0f0f0; width: 330px" >
            <img src="/yii2/web<?=$post->image ?>" width="300px" height="200px">
            <div class="caption">
                <h3><?= Html::encode("{$post->title}") ?></h3>
                <p><?= Html::encode("{$post->description}") ?></p>
                <p><a href="/yii2/web/home/post?id=<?=$post->id ?>" class="btn btn-primary" role="button">Кнопка</a></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>


<?= LinkPager::widget(['pagination' => $pagination]); ?>
