<?php
namespace src;

class ModuleInstaller implements Installable
{
    private $_sqlPath;
    private $_module;

    public function __construct(Module $module)
    {
        $this->_module = $module;
        $this->_sqlPath = App::config()['modulesPath'] . DIRECTORY_SEPARATOR . $module->getAlias() . DIRECTORY_SEPARATOR . 'tmp';
    }

    public function install()
    {
        if (file_exists($this->_sqlPath . DIRECTORY_SEPARATOR . 'install.sql')) {
            $db = Database::getInstance();
            $content = file_get_contents($this->_sqlPath . DIRECTORY_SEPARATOR . 'install.sql');
            $query = $db->prepare($content);
            $query->execute();

            return true;
        }

        return false;
    }

    public function uninstall()
    {
        if (file_exists($this->_sqlPath . DIRECTORY_SEPARATOR . 'uninstall.sql')) {
            $db = Database::getInstance();
            $content = file_get_contents($this->_sqlPath . DIRECTORY_SEPARATOR . 'uninstall.sql');
            $query = $db->prepare($content);
            $query->execute();

            return true;
        }

        return false;
    }
}