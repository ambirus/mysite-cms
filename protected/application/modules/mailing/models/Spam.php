<?php

namespace application\modules\mailing\models;

use src\Editable;
use src\Database;

class Spam implements Editable
{
    public static function tableName()
    {
        return 'module_mailing_spam';
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function create($data)
    {
        $db = Database::getInstance();
        $query = $db->prepare("TRUNCATE " . self::tableName());
        $query->execute();

        $query = $db->prepare("INSERT INTO " . self::tableName() . " (ips) VALUES (:ips)");
        $res = $query->execute([':ips' => $data['ips']]);

        return $res;

    }

    /**
     * @param null $id
     * @return mixed
     * @throws \Exception
     */
    public function read($id = null)
    {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM " . self::tableName());
        $query->execute();

        return $query->fetch()['ips'];
    }

    public function update($id, $data)
    {
    }

    public function delete($id)
    {
    }

}