<?php
namespace application\modules\admin\models\users;

use application\helpers\IpHelper;
use src\managers\ModuleManager;

class AuthManagerDb implements Identable
{
    public function login($login, $password)
    {
        $config = ModuleManager::get('admin')->config();

        if ($config['login'] == $login && $config['password'] == md5($password)) {

            $hash = md5(IpHelper::getClientIp() . $login);
            $_SESSION['uhash'] = $hash;
            $_SESSION['user'] = $login;

            $module = ModuleManager::get('admin');
            $module->save([
                'last_login' => time()
            ]);

            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['uhash']);
        unset($_SESSION['user']);
    }

    public function isLogged()
    {
        if (isset($_SESSION['uhash']) && $_SESSION['uhash'] == md5(IpHelper::getClientIp() . $_SESSION['user']))
            return true;

        return false;
    }
}