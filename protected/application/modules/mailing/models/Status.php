<?php

namespace application\modules\mailing\models;

class Status
{
    const STATUS_NEW = 0;
    const STATUS_DONE = 1;

    private $_list = [
        self::STATUS_NEW => '{{%New%}}',
        self::STATUS_DONE => '{{%Sent%}}'
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