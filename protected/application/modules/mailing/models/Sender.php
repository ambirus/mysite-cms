<?php

namespace application\modules\mailing\models;

abstract class Sender implements Sendable
{
    protected $params = [];
    protected $emails = [];

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function addEmail($email)
    {
        $this->emails[] = $email;
    }

    public function getEmailList()
    {
        return $this->emails;
    }
}