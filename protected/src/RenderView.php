<?php

namespace src;

use Exception;
use src\managers\AssetManager;
use src\managers\ModuleManager;
use src\routers\WebRouter;

class RenderView
{
    private $viewsPath;
    private $templatesPath;
    private $layoutPath;
    private $layout;
    private $layoutFile;

    /**
     * RenderView constructor.
     * @param $controller
     * @throws Exception
     */
    public function __construct($controller)
    {
        $config = App::config();

        if (!isset($config['appPath']) || trim($config['appPath']) == '') {
            throw new Exception('Application path is not defined in config file!');
        }            

        $moduleName = WebRouter::getCurrentModuleName();
        $controllerName = WebRouter::getCurrentControllerName();

        // layout

        if (is_subclass_of($controller, 'application\\modules\\admin\\controllers\\AdminController')) {
            // admin layout
            $this->layoutPath = $config['modulesPath'] . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 
                'views' . DIRECTORY_SEPARATOR . 'layouts';
        } elseif (is_dir($config['modulesPath'] . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 
            'views' . DIRECTORY_SEPARATOR . 'layouts')) {
            // module layout
            $this->layoutPath = $config['modulesPath'] . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 
                'views' . DIRECTORY_SEPARATOR . 'layouts';
        } else {
            // site layout
            $themePath = AssetManager::getThemePath(ModuleManager::get('site')->config()['theme']);
            $this->layoutPath = $config['modulesPath'] . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . 
                'views' . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $themePath . DIRECTORY_SEPARATOR . 
                'layouts';
        }

        $this->layout = $this->layoutPath . DIRECTORY_SEPARATOR . 'main.php';
        $this->layoutFile = 'main.php';

        if (file_exists($this->layout) === false)
            throw new Exception('This &laquo;main&raquo; layout is not found!');

        // templates

        $this->viewsPath = $config['modulesPath'] . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR .
            'views' . DIRECTORY_SEPARATOR;

        if (isset($themePath)) {
            $viewPath = str_replace('layouts', '', $this->layoutPath);

            if (is_dir($viewPath . $moduleName)) {
                $this->viewsPath = $viewPath . $moduleName . DIRECTORY_SEPARATOR;
            }
        }

        $this->templatesPath = $this->viewsPath . $controllerName . DIRECTORY_SEPARATOR;
    }

    /**
     * @param $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $this->layoutPath . DIRECTORY_SEPARATOR . $layout . '.php';
        $this->layoutFile = $layout . '.php';
    }

    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param $view
     * @param array $params
     * @throws Exception
     */
    public function render($view, $params = [])
    {
        $themeItems = $this->getThemeItems();

        if (file_exists($this->templatesPath . $view . '.php')) {

            ob_start();
            ob_implicit_flush(false);
            extract($params, EXTR_OVERWRITE);

            require($this->templatesPath . $view . '.php');
            $themeItems['content'] = ob_get_clean();

        } else throw new Exception('No such template &laquo;' . $view . '&raquo;! ');

        ob_start();
        ob_implicit_flush(false);
        extract($themeItems, EXTR_OVERWRITE);

        require($this->layout);

        echo I18n::translate(ob_get_clean());
    }

    /**
     * @param $view
     * @param array $params
     * @throws Exception
     */
    public function renderPartial($view, $params = [])
    {
        if (file_exists($this->templatesPath . $view . '.php')) {

            ob_start();
            ob_implicit_flush(false);
            extract($params, EXTR_OVERWRITE);
            require($this->templatesPath . $view . '.php');
            echo I18n::translate(ob_get_clean());

        } else throw new Exception('No such template &laquo;' . $view . '&raquo;! ');
        exit;
    }

    /**
     * @return array
     */
    private function getThemeItems()
    {
        $themeItems = [];

        if ($files = scandir($this->layoutPath)) {
            foreach ($files as $file) {
                if (!in_array($file, ['.', '..', $this->layoutFile])) {
                    $item = substr($file, 0, -4);
                    ob_start();
                    ob_implicit_flush(false);

                    require($this->layoutPath . DIRECTORY_SEPARATOR . $file);

                    $themeItems[$item] = ob_get_clean();
                }
            }
        }

        return $themeItems;
    }
}
