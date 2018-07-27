<?php
namespace application\modules\navigation\controllers;

use application\modules\admin\controllers\AdminController;
use application\modules\navigation\models\PrettyUrlForm;
use application\modules\navigation\models\PrettyUrl;
use src\Request;
use src\Url;
use Exception;

class PrettyController extends AdminController
{
    public function actionIndex()
    {
        $this->view->render('index', ['model' => (new PrettyUrl())->read(null)]);
    }

    public function actionCreate()
    {
        $model = new PrettyUrlForm();
        $success = null;

        if (Request::post() !== null) {
            if ($model->load(Request::post()) && $model->save()) {

                Url::redirect('/navigation/pretty/index');

            } else $success = false;
        }

        $this->view->render('create', ['success' => $success, 'model' => $model]);
    }

    public function actionUpdate($params)
    {
        if ($params['id'] === null)
            throw new Exception(('Не передан параметр id!'));

        $model = new PrettyUrlForm($params['id']);
        $success = null;

        if (Request::post() !== null) {
            if ($model->load(Request::post()) && $model->save()) {

                Url::redirect('/navigation/pretty/index');

            } else $success = false;
        }

        $this->view->render('update', ['id' => $params['id'], 'success' => $success, 'model' => $model]);
    }

    public function actionDelete($params)
    {
        if ($params['id'] === null)
            throw new Exception(('Не передан параметр id!'));

        if ((new PrettyUrl())->delete($params['id'])) {
            Url::redirect('/navigation/pretty/index');
        } else throw new Exception(('Ошибка удаления!'));

    }

    public function actionItems()
    {
        if (isset(Request::post()['model'])) {

            $className = Request::post()['model'];

            if (class_exists($className)) {
                $model = explode('\\', $className);
                $modelObj = new $className;
                $this->view->renderPartial('_items', ['model' => $model, 'items' => $modelObj->read(), 'link' => strtolower(array_pop($model))]);
            }
        }
    }
}