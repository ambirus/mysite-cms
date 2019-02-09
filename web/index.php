<?php

use src\App;
use src\Url;
use src\I18n;

ini_set("error_reporting", -1);
ini_set("display_errors", 1);

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$config = require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'config.php';

$i18n = new I18n();

try {
    $app = new App($config);
    $app->run();

} catch (Exception $e) {

    if (isset($config['debug']) && $config['debug'] == 1) {

        $message = $i18n->translate('{{%' . $e->getMessage() . '%}}');
        echo '<h4>'.$message.'</h4>';
        echo '<blockquote><p>' . $e->getFile() . '</p><p>' . str_replace('#', '<br>#', $e->getTraceAsString()) . '</p></blockquote>';

    } else Url::redirect('/404');

}