<?php
namespace application\modules\mailing\models;

interface Sendable
{
    public function addEmail($email);
    public function send();
}