<?php
namespace src;

use src\managers\ModuleManager;
use ErrorException;

class I18n
{
    private static $_languages = [
        'en' => [
            'title' => 'english',
            'icon' => 'usa.png'
        ],
        'ru' => [
            'title' => 'русский',
            'icon' => 'russia.png'
        ],


    ];

    public static function get($alias = null)
    {
        if ($alias !== null && isset(self::$_languages[$alias]))
            return self::$_languages[$alias];

        return self::$_languages;
    }

    public static function translate($content)
    {
        $lang = self::getCurrLang();
        $langFile = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'i18n' . DIRECTORY_SEPARATOR . $lang . '.php';

        if (!file_exists($langFile))
            return str_replace(['{{%', '%}}'], '', $content);

        $langArr = require $langFile;

        $modules = ModuleManager::get();
		if ($modules !== null) {
			foreach ($modules as $module) {
				$langArr = array_merge($langArr, $module->getLang($lang));
			}
		}
        
        preg_match_all('{{%(.+?)%}}', $content, $matches);

        if (sizeof($matches) > 0) {
            foreach ($matches[1] as $match) {
                if (isset($langArr[$match]))
                    $content = str_replace('{{%'.$match.'%}}', $langArr[$match], $content);
            }
        }

        return str_replace(['{{%', '%}}'], '', $content);
    }

    public static function getCurrLang()
    {
        $currLang = 'en';

        if (ModuleManager::get('site') !== null && method_exists(ModuleManager::get('site'), 'config') !== false) {
            $config = ModuleManager::get('site')->config();
            $currLang = $config['language'];
        }

        if (isset($_COOKIE['currLang']))
            $currLang = $_COOKIE['currLang'];

        if (isset($_GET['lang']))
            $currLang = $_GET['lang'];

        return $currLang;
    }

    public static function changeLang($lang)
    {
        setcookie('currLang', $lang, null, '/');
    }
}