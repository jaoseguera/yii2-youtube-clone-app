<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-expand-lg navbar-light bg-light shadow-sm',
    ],
]);
$menuItems = [
    ['label' => 'Create', 'url' => ['/video/create']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
}
if (Yii::$app->user->isGuest) {
    echo Html::tag('div', Html::a('Signup', ['/site/signup'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
    echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
} else {
    $menuItems[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['site/logout'],
        'linkOptions' => [
            'data-method' => 'post'
        ]
    ];
?>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline my-2 my-lg-0" action='<?php echo Url::to(['/video/search']); ?>'>
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name='keyword' value="<?php echo Yii::$app->request->get('keyword'); ?>">
            <button class="btn btn-outline-success my-2 my-sm-0">Search</button>
        </form>
    </nav>
<?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
}
NavBar::end();
?>