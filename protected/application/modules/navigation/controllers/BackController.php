<?php
namespace application\modules\navigation\controllers;

use application\modules\admin\controllers\AdminController;
use application\modules\navigation\models\NavigationManager;
use application\modules\navigation\models\NavigationItemManager;
use Exception;
use application\modules\navigation\models\NavigationItemsForm;
use application\modules\navigation\models\NavigationItemForm;
use src\Request;
use src\Url;

class BackController extends AdminController
{
    public function actionIndex($params)
    {
        $this->view->render('index', ['params' => $params, 'menus' => NavigationManager::model()->read(null)]);
    }

    public function actionItems($params)
    {
        if ($params['menuid'] === null)
            throw new Exception(('Не передан параметр menuid!'));

        $model = new NavigationItemsForm($params['menuid']);
        $success = null;

        if (Request::post() !== null) {
            if ($model->load(Request::post()) && $model->save()) {

                Url::redirect('/navigation/back/items/menuid=' . $params['menuid']);

            } else $success = false;
        }

        $this->view->render('items', ['menuid' => $params['menuid'], 'success' => $success, 'model' => $model]);
    }

    public function actionItemsCreate()
    {
        $model = new NavigationItemForm();
        $success = null;

        if (Request::post() !== null) {
            if ($model->load(Request::post()) && $model->save()) {

                Url::redirect('/navigation/back/items/menuid=main');

            } else $success = false;
        }

        $this->view->render('create', ['menuid' => 'main', 'success' => $success, 'model' => $model]);
    }

    public function actionItemsUpdate($params)
    {
        if ($params['id'] === null)
            throw new Exception(('Не передан параметр id!'));

        $model = new NavigationItemForm($params['id']);
        $success = null;

        if (Request::post() !== null) {
            if ($model->load(Request::post()) && $model->save()) {

                Url::redirect('/navigation/back/items/menuid=main');

            } else $success = false;
        }

        $this->view->render('update', ['menuid' => 'main', 'success' => $success, 'model' => $model]);
    }

    public function actionItemsDelete($params)
    {
        if ($params['id'] === null)
            throw new Exception(('Не передан параметр id!'));

        if (NavigationItemManager::model()->delete($params['id'])) {
            Url::redirect('/navigation/back/items/menuid=main');
        } else throw new Exception(('Ошибка удаления!'));
    }
}