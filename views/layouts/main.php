<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SiteAssetBundle;

SiteAssetBundle::register($this);

// $baseUrl =  Yii::$app->homeUrl;
// $languageUrl = $baseUrl . '/site/language';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
        ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
    ];
    if (Yii::$app->user->id == 2) {
        $menuItems = [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'Customers'), 'url' => ['/customers/index']],
            ['label' => Yii::t('app', 'Reservations'), 'url' => ['/reservations/index']],
            ['label' => Yii::t('app', 'Rooms'), 'url' => ['/rooms/index']],
            ['label' => Yii::t('app', 'Roles'), 'url' => ['/auth-items/index']],
            ['label' => Yii::t('app', 'Users'), 'url' => ['/users/index']],
        ];
    } else if (Yii::$app->user->id == 1) {
        $menuItems = [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'Customers'), 'url' => ['/customers/index']],
            ['label' => Yii::t('app', 'Reservations'), 'url' => ['/reservations/index']],
            ['label' => Yii::t('app', 'Rooms'), 'url' => ['/rooms/index']],
            ['label' => Yii::t('app', 'Users'), 'url' => ['/users/index']],
        ];
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    foreach (Yii::$app->params['languages'] as $key => $language) {
        $items[] = [
            'label' => $language, 'url' => '#',
            'options' => ['id' => $key ,'class' => 'navbar-nav lang']
        ];
    }

    $menuItems[] = [
        'label' => Yii::t('app', 'Languages'),
        'items' => $items
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<script>
    var baseUrl = "<?= Yii::$app->homeUrl ?>";
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
