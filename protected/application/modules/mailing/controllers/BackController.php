<?php
namespace application\modules\mailing\controllers;

use application\modules\admin\controllers\AdminController;
use application\modules\mailing\models\SettingsForm;
use application\modules\mailing\models\SpamForm;
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

    public function actionSpam()
    {
        $model = new SpamForm();
        $success = null;

        if (Request::post() !== null) {

            if ($model->load(Request::post()) && $model->save()) {

                $success = true;

            } else $success = false;
        }

        $this->view->render('spam', ['success' => $success, 'model' => $model]);
    }
}