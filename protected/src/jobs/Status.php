<?php

namespace src\jobs;

class Status
{
    const STATUS_INQUEUE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DONE = 2;

    private $_list = [
        self::STATUS_INQUEUE => '{{%Unprocessed%}}',
        self::STATUS_ACTIVE => '{{%Processing%}}',
        self::STATUS_DONE => '{{%Finished%}}'
    ];

    public function get($status = null)
    {
        if ($status === null)
            return $this->_list;

        if (isset($this->_list[$status]))
            return $this->_list[$status];

        return false;
    }
}