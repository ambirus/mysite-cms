<?php
namespace application\modules\navigation\models;

use src\Database;
use src\Editable;

class NavigationItem implements Editable
{
    public function create($data)
    {
        $db = Database::getInstance();
        $query = $db->prepare("INSERT INTO module_navigation_items (menu_id, url, alias, title, order_num, state) VALUES (1, :url, :alias, :title, :order_num, :state)");
        return $query->execute([':url' => $data['url'], ':alias' => $data['alias'], ':title' => $data['title'], ':order_num' => $data['order_num'], ':state' => $data['state']]);
    }

    public function read($id)
    {
        $db = Database::getInstance();

        $query = $db->prepare("SELECT * FROM `module_navigation_items` WHERE id=:id");
        $query->execute([':id' => $id]);
        $answer = $query->fetch();

        return $answer;
    }

    public function update($id, $data)
    {
        $db = Database::getInstance();
        $query = $db->prepare("UPDATE module_navigation_items SET url = :url, alias = :alias, title = :title, order_num = :order_num, state = :state WHERE id = :id");
        return $query->execute([':url' => $data['url'], ':alias' => $data['alias'], ':title' => $data['title'], ':order_num' => $data['order_num'], ':state' => $data['state'], ':id' => $id]);
    }

    public function delete($id)
    {
        $db = Database::getInstance();
        $query = $db->prepare("DELETE FROM module_navigation_items WHERE id = :id");

        return $query->execute([':id' => $id]);
    }
}