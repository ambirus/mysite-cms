<?php
namespace src\managers;

use src\App;
use ErrorException;

class AssetManager
{
    private static $_assetPatterns = [
        'css' => '<link rel="stylesheet" href="/assets/{{%cssPath%}}">',
        'js' => '<script src="/assets/{{%jsPath%}}"></script>'
    ];

    public static function generate($module)
    {
        $assets = $module->getAssets();

        if ($assets !== null && sizeof($assets) > 0) {

            $config = App::config();
            $alias = $module->getAlias();

            $assetsPath = $config['appPath'] . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $alias . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

            if (!is_dir($config['assetsPath']) || !is_writable($config['assetsPath']))
                throw new ErrorException('You must to create "assets" directory in the "web" directory and make it writable (chmod 0777 web/assets)!');

            if (is_dir($assetsPath . 'assets') && !file_exists($config['assetsPath'] . DIRECTORY_SEPARATOR . $alias))
                symlink($assetsPath . 'assets', $config['assetsPath'] . DIRECTORY_SEPARATOR . $alias);

            if ($alias == 'site') {
                $themePath = self::getThemePath($module->config()['theme']);
                $assetsPathTheme = $assetsPath . 'themes' . DIRECTORY_SEPARATOR . $themePath . DIRECTORY_SEPARATOR;

                if (is_dir($assetsPathTheme . 'assets') && !file_exists($config['assetsPath'] . DIRECTORY_SEPARATOR . $themePath  . '_theme')) {
                    symlink($assetsPathTheme . 'assets', $config['assetsPath'] . DIRECTORY_SEPARATOR . $themePath  . '_theme');
                }

            }

        }
    }

    public static function get($type, $isBack = false)
    {
        $config = App::config();
        $modules = ModuleManager::get();        
        $str = '';

        $ignoreBlock = !$isBack ? 'admin' : '';

        foreach ($modules as $alias => $module) {

            if (isset(self::$_assetPatterns[$type])) {

                $assets = $module->getAssets();

                if ($assets !== null && sizeof($assets) > 0) {
                    $alias = $module->getAlias();

                    if ($alias == $ignoreBlock || $isBack && $alias == 'site')
                        continue;

                    if (isset($assets[$type])) {
                        foreach ($assets[$type] as $asset) {
                            $str .= str_replace('{{%' . $type . 'Path%}}', $alias . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $asset, self::$_assetPatterns[$type]) . "\n";
                        }
                    }

                }

            }
        }

        $theme = $modules['site']->config()['theme'];
        $themePath = self::getThemePath($theme);

        $filesPath = $config['appPath'] . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $themePath . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . $type;

        if (is_dir($filesPath)) {

            if ($type == 'css' && $themePath == 'default') {

                if (!$isBack)
                    $str .= str_replace('{{%cssPath%}}', 'default_theme' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . $theme . '.css', self::$_assetPatterns[$type]) . "\n";

            } else {

                $files = scandir($filesPath);

                if (sizeof($files) > 0) {

                    foreach ($files as $file) {
                        if (!in_array($file, ['.', '..']) && preg_match('/(\.css|\.js)/', $file) > 0 && !$isBack) {
                            $str .= str_replace('{{%' . $type . 'Path%}}', $themePath . '_theme' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $file, self::$_assetPatterns[$type]) . "\n";
                        }
                    }

                }
            }

        }

        return $str;
    }

    public static function getThemePath($theme = null)
    {
        return ($theme == null || in_array($theme, ['blue', 'green', 'orange'])) ? 'default' : $theme;
    }

    public static function getThemes()
    {
        $themes = [];
        $config = App::config();
        $themesPath = $config['modulesPath'] . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'themes';

        $paths = scandir($themesPath);

        foreach ($paths as $path) {
            if (!in_array($path, ['.', '..', 'default']))
                $themes[$path] = $path;
        }

        return sizeof($themes) > 0 ? $themes : false;
    }
}