<?php

namespace application\modules\mailing\models;

class Status
{
    const STATUS_NEW = 0;
    const STATUS_DONE = 1;

    private $list = [
        self::STATUS_NEW => '{{%New%}}',
        self::STATUS_DONE => '{{%Sent%}}'
    ];

    public function get($status = null)
    {
        if ($status === null) {
            return $this->list;
        }

        if (isset($this->list[$status])) {
            return $this->list[$status];
        }

        return false;
    }
}