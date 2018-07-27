<?php

namespace src\jobs;

class Priority
{
    const PRIORITY_LOW = 2;
    const PRIORITY_NORMAL = 1;
    const PRIORITY_HIGH = 0;

    private $_list = [
        self::PRIORITY_LOW => '{{%Low priority%}}',
        self::PRIORITY_NORMAL => '{{%Normal priority%}}',
        self::PRIORITY_HIGH => '{{%High priority%}}'
    ];

    public function get($priority = null)
    {
        if ($priority === null)
            return $this->_list;

        if (isset($this->_list[$priority]))
            return $this->_list[$priority];

        return false;
    }
}