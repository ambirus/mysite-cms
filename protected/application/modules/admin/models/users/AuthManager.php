<?php

namespace application\modules\admin\models\users;

use Exception;

class AuthManager
{
    private static $manager;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$manager === null) {

            $userObject = new AuthManagerDb();

            if (!$userObject instanceof Identable) {
                throw new Exception(('Класс должен реализовывать интерфейс Identable!'));
            }

            self::$manager = $userObject;
        }

        return self::$manager;
    }
}