<?php
namespace application\modules\admin\controllers;

use application\modules\admin\models\users\AuthManager;
use src\Url;

class LogoutController extends AdminController
{
    public function actionIndex()
    {
        AuthManager::getInstance()->logout();
        Url::redirect('/admin');
    }
}