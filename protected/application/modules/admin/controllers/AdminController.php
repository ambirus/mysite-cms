<?php
namespace application\modules\admin\controllers;

use src\Controller;
use src\Url;
use application\modules\admin\models\users\AuthManager;

class AdminController extends Controller
{
    public function init()
    {
        session_start();

        if (AuthManager::getInstance()->isLogged() === false)
            Url::redirect('/admin/login');
    }
}