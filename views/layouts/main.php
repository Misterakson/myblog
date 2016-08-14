<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\AlertWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems =
        [
            ['label' => 'Home', 'url' => ['/home/index']],
        ];

    if(Yii::$app->user->isGuest):
        $menuItems[] = [
            'label' => 'Регистрация',
            'url' => ['/home/reg'],
        ];
        $menuItems[] = [
            'label' => 'Войти',
            'url' => ['/home/login']
        ];

    else:
        $menuItems[] = [
            'label' => 'Мой профиль',
            'url' => ['/home/profile']
        ];
        $menuItems[] = [
            'label' => 'Мои публикации',
            'url'  => ['/post/index']
        ];
        $menuItems[] = [
            'label' => "Выйти (".Yii::$app->user->identity['name'].")",
            'url' => ['/home/logout'],
            'linkOption' => [
                'data-method' => 'post'
            ]
        ];
    endif;

    echo Nav::widget([
        'items' => $menuItems,
        'activateParents' => true,
        'encodeLabels' => false,
        'options' => [
            'class' => 'navbar-nav navbar-right'
        ]
    ]);

//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => [
//            ['label' => 'Home', 'url' => ['/home/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
//            ['label' => 'Registration', 'url' => ['/home/reg']],
//            Yii::$app->user->isGuest ? (
//                ['label' => 'Login', 'url' => ['/home/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link']
//                )
//                . Html::endForm()
//                . '</li>'
//            )
//        ],
//    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= AlertWidget::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
