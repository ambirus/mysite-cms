<?php
namespace application\modules\site\controllers;

use application\modules\page\models\PageManager;
use application\modules\site\models\Captcha;
use application\modules\site\models\ContactForm;
use src\Controller;
use src\managers\ModuleManager;
use src\Request;
use Exception;

class IndexController extends Controller
{
    public function actionIndex($params)
    {
        if (!isset($params['id'])) {
            $defaultPage = ModuleManager::get('site')->config()['mainPage'];

            if (intval($defaultPage) == 0)
                throw new Exception('Не указана страница по умолчанию!');

            $params['id'] = $defaultPage;
        }

        $this->view->render('index', ['page' => PageManager::model()->read($params['id'])]);
    }

    public function actionContacts()
    {
        $model = new ContactForm();
        $success = null;

        if (Request::post() !== null) {
            if ($model->load(Request::post()) && $model->save()) {
                $success = true;
            } else $success = false;
        }

        $this->view->render('contacts', ['success' => $success, 'model' => $model]);
    }

    public function actionCaptcha()
    {
        session_start();
        $captcha = new Captcha();
        $_SESSION['captcha_keystring'] = $captcha->getKeyString();
        $captcha->draw();
    }

    public function action404()
    {
        $this->view->render('404');
    }
}