<?php
namespace application\modules\admin\controllers;

use src\Controller;
use application\modules\admin\models\users\AuthManager;
use src\Url;
use src\Request;
use application\modules\admin\models\LoginForm;

class LoginController extends Controller
{
    public function __construct()
    {
        session_start();

        if (AuthManager::getInstance()->isLogged())
            Url::redirect('/admin/index');

        parent::__construct();
        $this->view->setLayout('login');
    }

    public function actionIndex()
    {
        $model = new LoginForm();
        $success = null;

        if (Request::post() !== null) {

            if ($model->load(Request::post()) && $model->save()) {

                Url::redirect('/admin/index');

            } else $success = false;
        }

        $this->view->render('index', ['success' => $success, 'model' => $model]);
    }
}