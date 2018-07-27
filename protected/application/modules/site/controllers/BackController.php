<?php
namespace application\modules\site\controllers;

use application\modules\admin\controllers\AdminController;
use application\modules\page\models\PageManager;
use application\modules\site\models\BlocksForm;
use application\modules\site\models\SettingsForm;
use src\Request;

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new SettingsForm();
        $success = null;

        if (Request::post() !== null) {

            if ($model->load(Request::post()) && $model->save()) {

                $success = true;

            } else $success = false;
        }

        $this->view->render('index', ['success' => $success, 'model' => $model, 'pages' => PageManager::model()->read()]);
    }

    public function actionBlocks()
    {
        $model = new BlocksForm();
        $success = null;

        if (Request::post() !== null) {

            if ($model->load(Request::post()) && $model->save()) {

                $success = true;

            } else $success = false;
        }

        $this->view->render('blocks', ['success' => $success, 'model' => $model]);
    }
}