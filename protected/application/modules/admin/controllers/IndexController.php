<?php
namespace application\modules\admin\controllers;

use application\modules\admin\models\ModulesForm;
use src\managers\ModuleManager;
use src\Request;
use src\Url;

class IndexController extends AdminController
{
    public function actionIndex()
    {
        $model = new ModulesForm();
        $success = null;

        if (Request::post() !== null) {
            if ($model->load(Request::post()) && $model->save()) {
                Url::redirect('/admin/index');
            } else $success = false;
        }

        $this->view->render('index', ['success' => $success, 'modules' => ModuleManager::getNonSystem(), 'model' => $model]);
    }
}