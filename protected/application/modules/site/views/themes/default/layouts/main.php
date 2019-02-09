<?php

use src\managers\AssetManager;
use application\modules\site\models\TemplateManager;
use src\managers\ModuleManager;
use application\modules\navigation\models\NavigationManager;

$links = NavigationManager::model()->readItems('main');
$title = isset($title) ? $title : '';
$keywords = isset($keywords) ? $keywords : '';
$description = isset($description) ? $description : '';

?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?> &mdash; <?= ModuleManager::get('site')->config()['appName'] ?></title>
    <meta charset="utf-8">
    <meta name="title" content="<?= $title ?>">
    <meta name="keywords" content="<?= $keywords ?>">
    <meta name="description" content="<?= $description ?>">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">

    <?= AssetManager::get('css') ?>

    <?= TemplateManager::model()->read('google') ?>

</head>
<body>

<div id="openFancy" class="fancyDialog">
    <div>
        <span title="{{%Close%}}" class="close">X</span>
        <div></div>
    </div>
</div>

<nav>
    <div class="container">
        <div id="logoDiv">
            <a href="/"><?= TemplateManager::model()->read('logo') ?></a>
        </div>
        <div>
            <!-- start menu -->
            <div id="menu">
                <ul class="toplinks">
                    <?php foreach ($links['items'] as $id => $link) : ?>
                        <?php if ($link['state'] == 1) : ?>
                            <li><a href="<?= $link['url'] ?>" <?= isset($link['isActive']) ? 'class="active"' : '' ?>>{{%<?= $link['title'] ?>
                                    %}}</a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <a id="menu-toggle" href="#" class=" ">&#9776;</a>
            <!-- end menu -->
        </div>
    </div>
</nav>

<header>
    <div class="container">
        <?= TemplateManager::model()->read('header') ?>
    </div>
</header>

<section>
    <div class="container">
        <?= $content ?>
    </div>
</section>

<section class="vibrant">
    <div class="container">
        <?= TemplateManager::model()->read('links') ?>
    </div>
</section>

<footer>
    <div class="container">
        <?= TemplateManager::model()->read('footer') ?>
    </div>
</footer>

<?= TemplateManager::model()->read('yandex') ?>

<?= AssetManager::get('js') ?>

</body>
</html>