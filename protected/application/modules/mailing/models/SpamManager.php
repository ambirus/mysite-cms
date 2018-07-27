<?php
namespace application\modules\mailing\models;

class SpamManager
{
    public static function model()
    {
        return new Spam();
    }
}