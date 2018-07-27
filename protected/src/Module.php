<?php
namespace src;

use src\managers\AssetManager;

abstract class Module
{
    protected $alias;
    protected $assets;
    protected $config;
    protected $commands;

    public function __construct()
    {
        $arr = explode('\\', get_class($this));
        $this->alias = strtolower(str_replace('Module', '', array_pop($arr)));

        $configFile = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . $this->alias . DIRECTORY_SEPARATOR . 'config.php';

        if (file_exists($configFile)) {
            $this->config = require $configFile;
        }

        $db = Database::getInstance();
        
        $query = $db->prepare("SELECT * FROM `module_" . $this->alias . "_settings`");
        $query->execute();

        while ($answer = $query->fetch()) {
            $this->config[$answer['alias']] = $answer['value'];
            $this->config[$answer['alias'] . '_name'] = $answer['name'];
        }

        AssetManager::generate($this);
    }

    public function config()
    {
        return $this->config;
    }

    public function getAssets()
    {
        return $this->config['state'] == 1 ? $this->assets : '';
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function getLang($language)
    {
        $langArr = [];

        $langFile = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . $this->alias . DIRECTORY_SEPARATOR . 'i18n' . DIRECTORY_SEPARATOR .  $language. '.php';

        if (file_exists($langFile))
            $langArr = require $langFile;

        return $langArr;
    }

    public function save($values)
    {
        if (is_array($values)) {

            $installer = new ModuleInstaller($this);

            if (isset($values['installed']) && $this->config['installed'] == 1 && $values['installed'] == 0) {
                $installer->uninstall();

                return true;
            }

            if (isset($values['installed']) && $this->config['installed'] == 0 && $values['installed'] == 1) {
                $installer->install();
            }

            $db = Database::getInstance();

            foreach ($values as $k => $value) {
                if (strpos($k, 'name') === false) {

                    if (isset($this->config[$k]) && $this->config['installed'] == 1) {
                        $query = $db->prepare("UPDATE `module_" . $this->alias . "_settings` SET value = :value WHERE alias = :alias");
                        $res = $query->execute([':value' => $value, ':alias' => $k]);

                        if ($res === false)
                            return false;
                    }
                }
            }
        }

        return true;
    }

    public function getCommands()
    {
        return $this->commands;
    }
}