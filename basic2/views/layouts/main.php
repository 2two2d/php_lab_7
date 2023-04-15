<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="/php_lab_8/basic2/web/site/index" class="nav-link">Posts</a></li>
                <?php if(Yii::$app->request->cookies->getValue('roleID', 0) == 2):?>
                <li class="nav-item"><a href="/php_lab_8/basic2/web/site/posts-manage" class="nav-link">Manage posts</a></li>
                <li class="nav-item"><a href="/php_lab_8/basic2/web/site/logout" class="nav-link">Logout</a></li>
                <?php elseif(Yii::$app->request->cookies->getValue('roleID', 0) == 1):?>
                <li class="nav-item"><a href="/php_lab_8/basic2/web/site/logout" class="nav-link">Logout</a></li>
                <?php else:?>
                <li class="nav-item"><a href="/php_lab_8/basic2/web/site/register" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="/php_lab_8/basic2/web/site/login" class="nav-link">Login</a></li>
                <?php endif;?>
            </ul>
        </header>
        <hr class="border-4">
    </div>


<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
