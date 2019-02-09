<?php

namespace src;

use Exception;

class Table implements Editable
{
    protected $table = '{{%table_name%}}';
    protected $limit = 10;
    protected $orderBy = 'id DESC';
    private $db;
    private $params;

    /**
     * Table constructor.
     * @param array $params
     * @throws Exception
     */
    public function __construct($params = [])
    {
        if ($this->table == '{{%table_name%}}') {
            throw new Exception("No table name for model of " . get_class($this) . " !");
        }

        $this->db = Database::getInstance();
        $this->params = $params;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function setLimit($newLimit)
    {
        $this->limit = $newLimit;

        return $this;
    }

    public function getOrderBy()
    {
        return $this->orderBy;
    }

    public function setOrderBy($newOrderBy)
    {
        $this->orderBy = $newOrderBy;

        return $this;
    }

    public function tableName()
    {
        return $this->table;
    }

    /**
     * @param $data
     * @return string
     */
    public function create($data)
    {
        foreach ($data as $k => $v) {
            $keys[] = $k;
            $aliases[] = ':' . $k;
            $values[':' . $k] = $v;
        }

        $query = $this->db->prepare("INSERT INTO " . $this->table . " (" . implode(", ", $keys) . ") 
                              VALUES (" . implode(", ", $aliases) . ")");

        $res = $query->execute($values);

        if ($res === false) {
            return json_encode($this->db->errorInfo());
        }

        return $this->db->lastInsertId();
    }

    /**
     * @param null $id
     * @param null $step
     * @return array
     */
    public function read($id = null, $step = null)
    {
        if ($id === null) {
            $pages = [];

            // paging
            $query = $this->db->prepare("SELECT COUNT(*) AS c FROM " . $this->table);
            $query->execute();
            $pages['total'] = $query->fetch()['c'];

            if (in_array('countOnly', $this->params))
                return $pages['total'];

            $pages['limit'] = $this->limit;
            $offset = $step !== null ? $step * $this->limit - $this->limit : 0;

            //

            $query = $this->db->prepare("SELECT * FROM " . $this->table . " ORDER BY " . $this->orderBy . " LIMIT " .
                $this->limit . ' OFFSET ' . $offset);
            $query->execute();

            while ($answer = $query->fetch()) {
                $pages['items'][$answer['id']] = $answer;
            }

            return $pages;

        } else {

            $query = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
            $query->execute([':id' => $id]);

            return $query->fetch();
        }
    }

    /**
     * @param $id
     * @param $data
     * @return string
     */
    public function update($id, $data)
    {
        foreach ($data as $k => $v) {
            $aliases[] = $k . '=' . ':' . $k;
            $values[':' . $k] = $v;
        }
        $values[':id'] = $id;

        $query = $this->db->prepare("UPDATE " . $this->tableName() . " SET " . implode(", ", $aliases) .
            "  WHERE id = :id");

        $res = $query->execute($values);

        if ($res === false) {
            return json_encode($this->db->errorInfo());
        }

        return $res;
    }

    /**
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM " . $this->tableName() . " WHERE id = :id");

        $res = $query->execute([':id' => $id]);

        if ($res === false) {
            return json_encode($this->db->errorInfo());
        }

        return $res;
    }

    /**
     * @param $condition
     * @param null $step
     * @return array
     */
    public function readBy($condition, $step = null)
    {
        if (is_array($condition)) {

            foreach ($condition as $k => $v) {
                $conditions[] = $k . '=' . ':' . $k;
                $values[':' . $k] = $v;
            }

        } else {
            $values = [':id' => $condition];
            $conditions = "id = :id";
        }

        $pages = [];

        // paging
        $query = $this->db->prepare("SELECT COUNT(*) AS c FROM " . $this->table . " WHERE " . implode(" AND ", $conditions));
        $query->execute($values);
        $pages['total'] = $query->fetch()['c'];

        if (in_array('countOnly', $this->params))
            return $pages['total'];

        $pages['limit'] = $this->limit;
        $offset = $step !== null ? $step * $this->limit - $this->limit : 0;

        //

        $query = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE " . implode(" AND ", $conditions) . " ORDER BY " . $this->orderBy . " LIMIT " . $this->limit . ' OFFSET ' . $offset);
        $query->execute($values);

        while ($answer = $query->fetch()) {
            $pages['items'][$answer['id']] = $answer;
        }

        return $pages;
    }
}