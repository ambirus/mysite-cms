<?php
namespace application\modules\page\controllers;

use application\modules\page\models\PageManager;
use src\Controller;
use Exception;

class FrontController extends Controller
{
    public function actionIndex($params)
    {
        if (!isset($params['id']) || $params['id'] === null)
            throw new Exception(('Не передан параметр id!'));

        $model = PageManager::model()->read($params['id']);
        if ($model['state'] == 0)
            throw new Exception('Страница не найдена!');

        $this->view->render('index', ['model' => $model]);
    }
}