<?php
namespace src;

use ErrorException;
use src\managers\AssetManager;
use src\managers\ModuleManager;
use src\routers\WebRouter;

class RenderView
{
    private $_viewsPath;
	private $_templatesPath;
    private $_layoutPath;
	private $_layout;
	private $_layoutFile;

	public function __construct($controller)
    {
        $config = App::config();

        if (!isset($config['appPath']) || trim($config['appPath']) == '')
            throw new ErrorException('Application path is not defined in config file!');

        $moduleName = WebRouter::getCurrentModuleName();
        $controllerName = WebRouter::getCurrentControllerName();

        // layout

        if (is_subclass_of($controller, 'application\\modules\\admin\\controllers\\AdminController')) {
            // admin layout
            $this->_layoutPath = $config['modulesPath'] . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts';


        } else if (is_dir($config['modulesPath'] . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR. 'layouts')) {
            // module layout
            $this->_layoutPath = $config['modulesPath'] . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts';

        } else {
            // site layout
            $themePath = AssetManager::getThemePath(ModuleManager::get('site')->config()['theme']);
            $this->_layoutPath = $config['modulesPath'] . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $themePath . DIRECTORY_SEPARATOR . 'layouts';
        }

        $this->_layout = $this->_layoutPath . DIRECTORY_SEPARATOR . 'main.php';
        $this->_layoutFile = 'main.php';

        if (file_exists($this->_layout) === false)
            throw new ErrorException('This &laquo;main&raquo; layout is not found!');

        // templates

        $this->_viewsPath = $config['modulesPath'] . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

        if (isset($themePath)) {
            $viewPath = str_replace('layouts', '', $this->_layoutPath);

            if (is_dir($viewPath . $moduleName)) {
                $this->_viewsPath = $viewPath . $moduleName . DIRECTORY_SEPARATOR;
            }
        }

        $this->_templatesPath = $this->_viewsPath . $controllerName . DIRECTORY_SEPARATOR;

    }

    public function setLayout($layout)
    {
        $this->_layout = $this->_layoutPath . DIRECTORY_SEPARATOR . $layout . '.php';
        $this->_layoutFile = $layout . '.php';
    }

    public function getLayout()
    {
        return $this->_layout;
    }

    public function render($view, $params = [])
	{
	    $themeItems = $this->_getThemeItems();

		if (file_exists($this->_templatesPath . $view . '.php')) {

                ob_start();
                ob_implicit_flush(false);
                extract($params, EXTR_OVERWRITE);

                require ($this->_templatesPath . $view . '.php');
                $themeItems['content'] = ob_get_clean();

		} else throw new ErrorException('No such template &laquo;' . $view . '&raquo;! ');

        ob_start();
        ob_implicit_flush(false);
        extract($themeItems, EXTR_OVERWRITE);

        require ($this->_layout);

        echo I18n::translate(ob_get_clean());
	}

	public function renderPartial($view, $params = [])
    {
        if (file_exists($this->_templatesPath.$view . '.php')) {

            ob_start();
            ob_implicit_flush(false);
            extract($params, EXTR_OVERWRITE);
            require ($this->_templatesPath . $view . '.php');
            echo I18n::translate(ob_get_clean());

        } else throw new ErrorException('No such template &laquo;'. $view .'&raquo;! ');
        exit;
    }

	private function _getThemeItems()
    {
        $themeItems = [];

        if ($files = scandir($this->_layoutPath)) {
            foreach ($files as $file) {
                if (!in_array($file, ['.', '..', $this->_layoutFile])) {
                    $item = substr($file, 0, -4);
                    ob_start();
                    ob_implicit_flush(false);

                    require ($this->_layoutPath . DIRECTORY_SEPARATOR. $file);

                    $themeItems[$item] = ob_get_clean();
                }
            }
        }

        return $themeItems;
    }
}
