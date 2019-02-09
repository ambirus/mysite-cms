<?php

namespace src;

class ModuleInstaller implements Installable
{
    private $sqlPath;
    private $module;

    /**
     * ModuleInstaller constructor.
     * @param Module $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
        $this->sqlPath = App::config()['modulesPath'] . DIRECTORY_SEPARATOR . $module->getAlias() .
            DIRECTORY_SEPARATOR . 'tmp';
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function install()
    {
        if (file_exists($this->sqlPath . DIRECTORY_SEPARATOR . 'install.sql')) {
            $db = Database::getInstance();
            $content = file_get_contents($this->sqlPath . DIRECTORY_SEPARATOR . 'install.sql');
            $query = $db->prepare($content);
            $query->execute();

            return true;
        }

        return false;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function uninstall()
    {
        if (file_exists($this->sqlPath . DIRECTORY_SEPARATOR . 'uninstall.sql')) {
            $db = Database::getInstance();
            $content = file_get_contents($this->sqlPath . DIRECTORY_SEPARATOR . 'uninstall.sql');
            $query = $db->prepare($content);
            $query->execute();

            return true;
        }

        return false;
    }
}