<?php
namespace application\modules\navigation\models;

use src\Database;
use src\Editable;
use src\Url;

class Navigation implements Editable
{
    public function create($data)
    {
        return;
    }

    public function read($id)
    {
        $db = Database::getInstance();
        $items = [];

        if ($id === null) {
            $query = $db->prepare("SELECT `module_navigation`.*, COUNT(`module_navigation_items`.id) as c FROM `module_navigation` 
                                  LEFT JOIN `module_navigation_items` ON `module_navigation_items`.menu_id = `module_navigation`.id 
                                  GROUP BY `module_navigation`.id");
            $query->execute();

            while ($answer = $query->fetch()) {
                $items[$answer['id']] = $answer;
            }
        }

        return $items;
    }

    public function update($id, $data)
    {
        return;
    }

    public function delete($id)
    {
        return;
    }

    public function readItems($menu)
    {
        $db = Database::getInstance();
        $items = [];

        $query = $db->prepare("SELECT module_navigation_items.*, module_navigation.name FROM `module_navigation` 
                                LEFT JOIN `module_navigation_items` ON module_navigation.id = module_navigation_items.menu_id 
                                WHERE module_navigation.alias=:menuAlias 
                                ORDER BY module_navigation_items.order_num ASC");
        $query->execute([':menuAlias' => $menu]);

        while ($answer = $query->fetch()) {
            $items['menu'] = $answer['name'];

            if ($answer['id'] !== null) {

                if ($this->_checkUrl($answer['url']))
                    $answer['isActive'] = 1;

                $items['items'][$answer['id']] = $answer;
            }
        }

        return $items;
    }

    public function readAdminItems()
    {
        $items = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'menu.php';

        return $items;
    }

    private function _checkUrl($url)
    {
        $currUrl = Url::current();

        if ($currUrl == $url)
            return true;

        if ($url != '/' && strpos($currUrl, $url) !== false)
            return true;

        return false;
    }
}