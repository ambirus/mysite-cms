<?php
namespace application\modules\site\models;

use src\Database;
use src\Editable;
use src\managers\ModuleManager;

class Template implements Editable
{
    private $_module;

    public function __construct()
    {
        $this->_module = ModuleManager::get('site');
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function read($id)
    {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT value FROM module_site_settings WHERE alias = :alias");
        $query->execute([':alias' => $id]);

        $answer = $query->fetch();

        return $answer['value'];
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}