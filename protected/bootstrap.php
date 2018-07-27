<?php

spl_autoload_register(function ($class) {

    $pathParts = explode('\\', $class);
    $className = array_pop($pathParts);
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'protected' .DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $pathParts);
    $fileClass = $filePath . DIRECTORY_SEPARATOR . $className . '.php';

    if (is_dir($filePath) && file_exists($fileClass)) {
        require_once $fileClass;
    }
});

$dbFile = __DIR__ . DIRECTORY_SEPARATOR . 'db.php';

if (file_exists($dbFile)) {
    $db = require_once $dbFile;
} else {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'installer' . DIRECTORY_SEPARATOR . 'install.php';
    $installator = new Installator();
    $installator->run();
}