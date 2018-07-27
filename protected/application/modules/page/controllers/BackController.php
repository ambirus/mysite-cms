<?php
namespace application\modules\page\controllers;

use application\modules\admin\controllers\AdminController;
use application\modules\page\models\PageManager;
use Exception;
use src\Request;
use application\modules\page\models\PageForm;
use src\Url;
use src\Pagination;

class BackController extends AdminController
{
    public function actionIndex($params)
    {
        $step = isset($params['page']) ? $params['page'] : null;
        $pages = PageManager::model()->read(null, $step);

        $this->view->render('index', ['pages' => $pages, 'pager' => (new Pagination($pages['total'], $pages['limit']))->get($step)]);
    }

    public function actionCreate()
    {
        $model = new PageForm();
        $success = null;

        if (Request::post() !== null) {
            if ($model->load(Request::post()) && $model->save()) {

                Url::redirect('/page/back');

            } else $success = false;
        }

        $this->view->render('create', ['success' => $success, 'model' => $model]);
    }

    public function actionUpdate($params)
    {
        if ($params['id'] === null)
            throw new Exception(('Не передан параметр id!'));

        $model = new PageForm($params['id']);
        $success = null;

        if (Request::post() !== null) {
            if ($model->load(Request::post()) && $model->save()) {

                $success = true;

            } else $success = false;
        }

        $this->view->render('update', ['success' => $success, 'model' => $model]);
    }

    public function actionDelete($params)
    {
        if ($params['id'] === null)
            throw new Exception(('Не передан параметр id!'));

        if (PageManager::model()->delete($params['id'])) {
            Url::redirect('/page/back');
        } else throw new Exception(('Ошибка удаления!'));
    }
}