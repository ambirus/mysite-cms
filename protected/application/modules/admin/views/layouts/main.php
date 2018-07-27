<?php

use application\modules\navigation\models\NavigationManager;
use src\I18n;
use src\managers\AssetManager;
use src\managers\ModuleManager;

$links = NavigationManager::model()->readAdminItems();
$currLang = I18n::getCurrLang();
$title = isset($title) ? $title : '{{%Admin area%}}';
$active = isset($active) ? $active : 'dashboard';
$modules = ModuleManager::getNonSystem();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?> &mdash; {{%Admin area%}} MySite CMS</title>

    <link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/admin/css/styles.css" rel="stylesheet">
    <link href="/assets/admin/js/jquery-ui/jquery-ui.css" rel="stylesheet">
    <link href="/assets/admin/js/jquery-ui/jquery-ui-timepicker-addon.css" rel="stylesheet">

    <?=AssetManager::get('css', true)?>

    <script>
        document.currLang = '<?=$currLang?>';
    </script>

    <script src="/assets/site/js/jquery.min.js"></script>
    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <script src="/assets/admin/js/jquery-ui/jquery-ui.js"></script>
    <?php if ($currLang != 'en') : ?>
        <script src="/assets/admin/js/jquery-ui/i18n/datepicker-<?=$currLang?>.js"></script>
    <?php endif; ?>
    <script src="/assets/admin/js/jquery-ui/jquery-ui-timepicker-addon.js"></script>

    <!--Icons-->
    <script src="/assets/admin/js/admin.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="/assets/admin/js/html5shiv.js"></script>
    <script src="/assets/admin/js/respond.min.js"></script>
    <![endif]-->
    <script src="/assets/admin/js/ckeditor/ckeditor.js"></script>
    <script src="/assets/admin/js/user.js"></script>

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><span>MySite CMS</span></a>
        </div>

    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <?php foreach ($links as $url => $link) : ?>
            <?php if ($link['state'] == 1) : ?>
            <li <?=($active  == $link['alias']) ? 'class="active"' : ''?> ><a href="<?=$url?>"><?=$link['icon']?> {{%<?=$link['title']?>%}}</a></li>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if (sizeof($modules)) : ?>
            <li role="presentation" class="divider"></li>
            <li><div style="padding: 10px 15px; font-size: 1.2em">{{%Installed modules%}}</div></li>
            <?php foreach ($modules as $k => $module) : ?>
                <?php if ($module->config()['installed'] == 1) : ?>
                <li <?=($active  == $k) ? 'class="active"' : ''?> ><a href="/<?=$k?>/back"> <?=I18n::translate($module->config()['name'])?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <li role="presentation" class="divider"></li>
        <li><a href="/admin/logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> {{%Logout%}}</a></li>
    </ul>
    <div class="attribution">&copy; <a href="http://mysite-cms.ru">MySite CMS</a>, <?=date('Y')?></div>





</div><!--/.sidebar-->

<?=$content?>


<?=AssetManager::get('js', true)?>

</body>

</html>