<?php
namespace application\modules\admin\controllers;

use application\modules\admin\models\SettingsForm;
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

        $this->view->render('index', ['success' => $success, 'model' => $model]);
    }
}